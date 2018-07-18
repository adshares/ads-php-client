<?php

namespace Adshares\Ads;

use Adshares\Ads\Command\AbstractTransactionCommand;
use Adshares\Ads\Command\BroadcastCommand;
use Adshares\Ads\Command\GetAccountCommand;
use Adshares\Ads\Command\GetAccountsCommand;
use Adshares\Ads\Command\GetBlockCommand;
use Adshares\Ads\Command\GetBlockIdsCommand;
use Adshares\Ads\Command\GetBroadcastCommand;
use Adshares\Ads\Command\GetMeCommand;
use Adshares\Ads\Command\GetMessageCommand;
use Adshares\Ads\Command\GetMessageIdsCommand;
use Adshares\Ads\Command\SendManyCommand;
use Adshares\Ads\Command\SendOneCommand;
use Adshares\Ads\Driver\DriverInterface;
use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Exception\CommandException;
use Adshares\Ads\Response\BroadcastResponse;
use Adshares\Ads\Response\GetAccountResponse;
use Adshares\Ads\Response\GetAccountsResponse;
use Adshares\Ads\Response\GetBlockResponse;
use Adshares\Ads\Response\GetBlockIdsResponse;
use Adshares\Ads\Response\GetBroadcastResponse;
use Adshares\Ads\Response\GetMessageIdsResponse;
use Adshares\Ads\Response\GetMessageResponse;
use Adshares\Ads\Response\SendManyResponse;
use Adshares\Ads\Response\SendOneResponse;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Wrapper class used to interact with ADS wallet client.
 */
class AdsClient implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * @var DriverInterface
     */
    protected $driver;

    /**
     * AdsClient constructor.
     *
     * @param DriverInterface $driver
     * @param LoggerInterface|null $logger
     */
    public function __construct(DriverInterface $driver, LoggerInterface $logger = null)
    {
        $this->driver = $driver;
        if (null === $logger) {
            $logger = new NullLogger();
        }
        $this->logger = $logger;
    }

    /**
     * Sets response entities map.
     *
     * @param array $map
     */
    public static function setEntityMap(array $map): void
    {
        EntityFactory::setEntityMap($map);
    }

    /**
     * Fills last account hash and message id in request. Function needs to be called before transaction.
     * Otherwise above parameters should be passed explicitly.
     *
     * @param AbstractTransactionCommand $transaction
     *
     * @param bool $force force set msid and hash
     *
     * @throws CommandException
     */
    private function prepareTransaction(AbstractTransactionCommand $transaction, bool $force = false): void
    {
        if (!$force && null !== $transaction->getLastMsid()) {
            return;
        }

        $sender = $transaction->getSender();
        if (null !== $sender) {
            $resp = $this->getAccount($sender);
        } else {
            $resp = $this->getMe();
        }
        $transaction->setLastMsid($resp->getAccount()->getMsid());
        $transaction->setLastHash($resp->getAccount()->getHash());
    }

    /**
     * Sends broadcast message to blockchain network.
     *
     * @param BroadcastCommand $command BroadcastCommand
     * @param bool $isDryRun if true, transaction won't be send to network
     *
     * @return BroadcastResponse
     */
    public function broadcast(BroadcastCommand $command, bool $isDryRun = false): BroadcastResponse
    {
        $this->prepareTransaction($command);
        $response = $this->driver->executeTransaction($command, $isDryRun);

        return new BroadcastResponse($response->getRawData());
    }

    /**
     * Returns account data.
     *
     * @param string $address account address
     *
     * @return GetAccountResponse
     *
     * @throws CommandException
     */
    public function getAccount(string $address): GetAccountResponse
    {
        $command = new GetAccountCommand($address);
        $response = $this->driver->executeCommand($command);

        return new GetAccountResponse($response->getRawData());
    }

    /**
     * Returns account list for node.
     *
     * @param int $node node
     * @param null|string $blockId block id, time in Unix Epoch seconds as hexadecimal string.
     *                             If null, last block will be taken.
     *
     * @return GetAccountsResponse
     *
     * @throws CommandException
     */
    public function getAccounts(int $node, ?string $blockId = null): GetAccountsResponse
    {
        $command = new GetAccountsCommand($node, $blockId);
        $response = $this->driver->executeCommand($command);

        return new GetAccountsResponse($response->getRawData());
    }

    /**
     * Returns block data.
     *
     * @param null|string $blockId block id, time in Unix Epoch seconds as hexadecimal string.
     *                             If null, last block will be taken.
     *
     * @return GetBlockResponse
     *
     * @throws CommandException
     */
    public function getBlock(?string $blockId = null): GetBlockResponse
    {
        $command = new GetBlockCommand($blockId);
        $response = $this->driver->executeCommand($command);

        return new GetBlockResponse($response->getRawData());
    }

    /**
     * Updates block data for selected period and returns ids of updated blocks.
     *
     * @param null|string $blockIdFrom starting block id, time in Unix Epoch seconds as hexadecimal string.
     *                             If null, first block (genesis) will be taken.
     * @param null|string $blockIdTo ending block id, time in Unix Epoch seconds as hexadecimal string.
     *                             If null, last block will be taken.
     *
     * @return GetBlockIdsResponse
     *
     * @throws CommandException
     */
    public function getBlockIds(?string $blockIdFrom = null, ?string $blockIdTo = null): GetBlockIdsResponse
    {
        $command = new GetBlockIdsCommand($blockIdFrom, $blockIdTo);
        $response = $this->driver->executeCommand($command);

        return new GetBlockIdsResponse($response->getRawData());
    }

    /**
     * Collects broadcast messages for particular block. Messages are in random order and can be duplicated.
     *
     * @param null|string $blockId block id, time in Unix Epoch seconds as hexadecimal string.
     *                             If null, last block will be taken.
     *
     * @return GetBroadcastResponse
     *
     * @throws CommandException
     */
    public function getBroadcast(?string $blockId = null): GetBroadcastResponse
    {
        $command = new GetBroadcastCommand($blockId);
        $response = $this->driver->executeCommand($command);

        return new GetBroadcastResponse($response->getRawData());
    }

    /**
     * Returns current account data. Current account is the account, which was used to initialize AdsClient.
     *
     * @return GetAccountResponse
     *
     * @throws CommandException
     */
    public function getMe(): GetAccountResponse
    {
        $command = new GetMeCommand();
        $response = $this->driver->executeCommand($command);

        return new GetAccountResponse($response->getRawData());
    }

    /**
     * Returns message data. Each message contains one or more transactions.
     *
     * @param string $messageId message id
     * @param null|string $blockId block id, time in Unix Epoch seconds as hexadecimal string.
     *                             If null, block will be calculated automatically.
     *
     * @return GetMessageResponse
     *
     * @throws CommandException
     */
    public function getMessage(string $messageId, ?string $blockId = null): GetMessageResponse
    {
        $command = new GetMessageCommand($messageId, $blockId);
        $response = $this->driver->executeCommand($command);

        return new GetMessageResponse($response->getRawData());
    }

    /**
     * Returns message ids for selected block.
     *
     * @param null|string $blockId block id, time in Unix Epoch seconds as hexadecimal string.
     *                             If null, last block will be taken.
     *
     * @return GetMessageIdsResponse
     *
     * @throws CommandException
     */
    public function getMessageIds(?string $blockId = null): GetMessageIdsResponse
    {
        $command = new GetMessageIdsCommand($blockId);
        $response = $this->driver->executeCommand($command);

        return new GetMessageIdsResponse($response->getRawData());
    }

    /**
     * Transfers funds to many accounts.
     *
     * @param SendManyCommand $command SendManyCommand
     * @param bool $isDryRun if true, transaction won't be send to network
     * @return SendManyResponse
     */
    public function sendMany(SendManyCommand $command, bool $isDryRun = false): SendManyResponse
    {
        $this->prepareTransaction($command);
        $response = $this->driver->executeTransaction($command, $isDryRun);

        return new SendManyResponse($response->getRawData());
    }

    /**
     * Transfers funds to one account.
     *
     * @param SendOneCommand $command SendOneCommand
     * @param bool $isDryRun if true, transaction won't be send to network
     * @return SendOneResponse
     */
    public function sendOne(SendOneCommand $command, bool $isDryRun = false): SendOneResponse
    {
        $this->prepareTransaction($command);
        $response = $this->driver->executeTransaction($command, $isDryRun);

        return new SendOneResponse($response->getRawData());
    }

    //    TODO: (Yodahack) : disscuss placement of this methods (currently copied to Adshares\Adserver\Http\Utils)
    //    public static function normalizeAddress($address)
    //    {
    //        $x = preg_replace('/[^0-9A-FX]+/', '', strtoupper($address));
    //        if (strlen($x) != 16) {
    //            throw new \RuntimeException("Invalid adshares address");
    //        }
    //        return sprintf("%s-%s-%s", substr($x, 0, 4), substr($x, 4, 8), substr($x, 12, 4));
    //    }
    //
    //    public static function normalizeTxid($txid)
    //    {
    //        $x = preg_replace('/[^0-9A-F]+/', '', strtoupper($txid));
    //        if (strlen($x) != 16) {
    //            throw new \RuntimeException("Invalid adshares address");
    //        }
    //        return sprintf("%s:%s:%s", substr($x, 0, 4), substr($x, 4, 8), substr($x, 12, 4));
    //    }
}
