<?php

namespace Adshares\Ads;

use Adshares\Ads\Command\AbstractTransaction;
use Adshares\Ads\Command\BroadcastCommand;
use Adshares\Ads\Command\GetAccountCommand;
use Adshares\Ads\Command\GetBroadcastCommand;
use Adshares\Ads\Command\GetMeCommand;
use Adshares\Ads\Driver\DriverInterface;
use Adshares\Ads\Exception\CommandException;
use Adshares\Ads\Response\BroadcastResponse;
use Adshares\Ads\Response\GetAccountResponse;
use Adshares\Ads\Response\GetBroadcastResponse;
use Adshares\Ads\Response\GetMeResponse;

/**
 * Wrapper class used to interact with ADS wallet client
 */
class AdsClient
{

    /**
     *
     * @var DriverInterface
     */
    protected $driver;

    /**
     * Client constructor.
     *
     * @param DriverInterface $driver
     */
    public function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    /**
     *
     * @param AbstractTransaction $transaction
     * @throws CommandException
     */
    private function prepareTransaction(AbstractTransaction $transaction)
    {
        $getMeResponse = $this->getMe();
        $transaction->setLastHash($getMeResponse->getAccount()->getHash());
        $transaction->setLastMessageId($getMeResponse->getAccount()->getMsid());
    }

    /**
     *
     * @param  string $message hexadecimal string with even number of characters
     * @return BroadcastResponse
     * @throws CommandException
     */
    public function broadcast($message): BroadcastResponse
    {
        $command = new BroadcastCommand($message);
        $this->prepareTransaction($command);
        $response = $this->driver->executeCommand($command);

        return new BroadcastResponse($response->getRawData());
    }

    /**
     *
     * @param string $address
     * @return GetAccountResponse
     * @throws CommandException
     */
    public function getAccount(string $address): GetAccountResponse
    {
        $command = new GetAccountCommand($address);
        $response = $this->driver->executeCommand($command);

        return new GetAccountResponse($response->getRawData());
    }

    /**
     *
     * @param null|string $from block time in Unix Epoch seconds as hexadecimal String, 0 for last block
     * @return GetBroadcastResponse
     * @throws CommandException
     */
    public function getBroadcast(string $from = null): GetBroadcastResponse
    {
        $command = new GetBroadcastCommand($from);
        $response = $this->driver->executeCommand($command);

        return new GetBroadcastResponse($response->getRawData());
    }

    /**
     *
     * @return GetMeResponse
     * @throws CommandException
     */
    public function getMe(): GetMeResponse
    {
        $command = new GetMeCommand();
        $response = $this->driver->executeCommand($command);

        return new GetMeResponse($response->getRawData());
    }

    //    public function broadcast($message)
    //    {
    //        if (!$this->my_account) {
    //            $this->getAccount();
    //        }
    //
    //        $cmd = new EscMessage();
    //        $cmd->setHeader('broadcast');
    //        $cmd->message = bin2hex($message);
    //        return $this->executeCommand($cmd)[0];
    //    }

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
