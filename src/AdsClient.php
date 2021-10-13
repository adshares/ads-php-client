<?php

/**
 * Copyright (c) 2018-2021 Adshares sp. z o.o.
 *
 * This file is part of ADS PHP Client
 *
 * ADS PHP Client is free software: you can redistribute and/or modify it
 * under the terms of the GNU General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ADS PHP Client is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ADS PHP Client. If not, see <https://www.gnu.org/licenses/>
 */

namespace Adshares\Ads;

use Adshares\Ads\Command\AbstractTransactionCommand;
use Adshares\Ads\Command\ChangeAccountKeyCommand;
use Adshares\Ads\Command\ChangeNodeKeyCommand;
use Adshares\Ads\Command\CreateAccountCommand;
use Adshares\Ads\Command\GetAccountCommand;
use Adshares\Ads\Command\GetAccountsCommand;
use Adshares\Ads\Command\GetBlockCommand;
use Adshares\Ads\Command\GetBlockIdsCommand;
use Adshares\Ads\Command\GetBroadcastCommand;
use Adshares\Ads\Command\GetLogCommand;
use Adshares\Ads\Command\GetMeCommand;
use Adshares\Ads\Command\GetMessageCommand;
use Adshares\Ads\Command\GetMessageIdsCommand;
use Adshares\Ads\Command\GetTransactionCommand;
use Adshares\Ads\Driver\DriverInterface;
use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Exception\CommandException;
use Adshares\Ads\Response\ChangeAccountKeyResponse;
use Adshares\Ads\Response\ChangeNodeKeyResponse;
use Adshares\Ads\Response\CreateAccountResponse;
use Adshares\Ads\Response\GetAccountResponse;
use Adshares\Ads\Response\GetAccountsResponse;
use Adshares\Ads\Response\GetBlockResponse;
use Adshares\Ads\Response\GetBlockIdsResponse;
use Adshares\Ads\Response\GetBroadcastResponse;
use Adshares\Ads\Response\GetLogResponse;
use Adshares\Ads\Response\GetMessageIdsResponse;
use Adshares\Ads\Response\GetMessageResponse;
use Adshares\Ads\Response\GetTransactionResponse;
use Adshares\Ads\Response\TransactionResponse;
use DateTimeInterface;
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
     * @param DriverInterface      $driver
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
     * @param string[] $map
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
     * @param bool                       $force       force set msid and hash
     *
     * @throws CommandException
     */
    private function prepareTransaction(AbstractTransactionCommand $transaction, bool $force = false): void
    {
        if (!$force && (null !== $transaction->getLastMsid()) && (null !== $transaction->getLastHash())) {
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
     * Executes `change_account_key` transaction.
     *
     * @param  ChangeAccountKeyCommand $command
     * @param  bool                    $isDryRun if true, transaction won't be send to network
     * @return ChangeAccountKeyResponse
     */
    public function changeAccountKey(ChangeAccountKeyCommand $command, bool $isDryRun = false): ChangeAccountKeyResponse
    {
        $this->prepareTransaction($command);
        $response = $this->driver->executeTransaction($command, $isDryRun);

        return new ChangeAccountKeyResponse($response->getRawData());
    }

    /**
     * Executes `change_node_key` transaction.
     *
     * @param  ChangeNodeKeyCommand $command
     * @param  bool                 $isDryRun if true, transaction won't be send to network
     * @return ChangeNodeKeyResponse
     */
    public function changeNodeKey(ChangeNodeKeyCommand $command, bool $isDryRun = false): ChangeNodeKeyResponse
    {
        $this->prepareTransaction($command);
        $response = $this->driver->executeTransaction($command, $isDryRun);

        return new ChangeNodeKeyResponse($response->getRawData());
    }

    /**
     * Executes `create_account` transaction.
     *
     * @param  CreateAccountCommand $command
     * @param  bool                 $isDryRun if true, transaction won't be send to network
     * @return CreateAccountResponse
     */
    public function createAccount(CreateAccountCommand $command, bool $isDryRun = false): CreateAccountResponse
    {
        $this->prepareTransaction($command);
        $response = $this->driver->executeTransaction($command, $isDryRun);

        return new CreateAccountResponse($response->getRawData());
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
     * @param string      $nodeId  node id (hex)
     * @param null|string $blockId block id, time in Unix Epoch seconds as hexadecimal string.
     *                             If null, last block will be taken.
     *
     * @return GetAccountsResponse
     *
     * @throws CommandException
     */
    public function getAccounts(string $nodeId, ?string $blockId = null): GetAccountsResponse
    {
        $node = (int)hexdec($nodeId);
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
     *                                 If null, first block (genesis) will be taken.
     * @param null|string $blockIdTo   ending block id, time in Unix Epoch seconds as hexadecimal string.
     *                                 If null, last block will be taken.
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
     * Returns available log event.
     *
     * @param null|DateTimeInterface $from start date of event log
     *
     * @return GetLogResponse
     *
     * @throws CommandException
     */
    public function getLog(?DateTimeInterface $from = null): GetLogResponse
    {
        $command = new GetLogCommand($from);
        $response = $this->driver->executeCommand($command);

        return new GetLogResponse($response->getRawData());
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
     * @param string      $messageId message id
     * @param null|string $blockId   block id, time in Unix Epoch seconds as hexadecimal string.
     *                               If null, block will be calculated automatically.
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
     * Returns single transaction data.
     *
     * @param string $txid transaction id
     *
     * @return GetTransactionResponse
     *
     * @throws CommandException
     */
    public function getTransaction(string $txid): GetTransactionResponse
    {
        $command = new GetTransactionCommand($txid);
        $response = $this->driver->executeCommand($command);

        return new GetTransactionResponse($response->getRawData());
    }

    /**
     * Executes transaction.
     * `AbstractTransactionCommand` can be one of:
     * - `BroadcastCommand`: Sends broadcast message to blockchain network;
     * - `CreateNodeCommand`: Creates node in blockchain network;
     * - `SendManyCommand`: Transfers funds to many accounts;
     * - `SendOneCommand`: Transfers funds to one account;
     *
     * Also commands `ChangeNodeKeyCommand`, `CreateAccountCommand` can be used,
     * but separate functions are prepared especially for them.
     *
     * @param  AbstractTransactionCommand $command
     * @param  bool                       $isDryRun if true, transaction won't be send to network
     * @return TransactionResponse
     */
    public function runTransaction(AbstractTransactionCommand $command, bool $isDryRun = false): TransactionResponse
    {
        $this->prepareTransaction($command);
        $response = $this->driver->executeTransaction($command, $isDryRun);

        return new TransactionResponse($response->getRawData());
    }
}
