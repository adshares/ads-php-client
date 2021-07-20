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

namespace Adshares\Ads\Entity;

use Adshares\Ads\Exception\AdsException;

/**
 * Class EntityFactory
 *
 * @package Adshares\Ads\Entity
 */
class EntityFactory
{
    /**
     * @var array
     */
    private static $entityMap = [
        'Account' => '\Adshares\Ads\Entity\Account',
        'Block' => '\Adshares\Ads\Entity\Block',
        'Broadcast' => '\Adshares\Ads\Entity\Broadcast',
        'Message' => '\Adshares\Ads\Entity\Message',
        'NetworkTx' => '\Adshares\Ads\Entity\NetworkTx',
        'NewAccount' => '\Adshares\Ads\Entity\NewAccount',
        'Node' => '\Adshares\Ads\Entity\Node',
        'Tx' => '\Adshares\Ads\Entity\Tx',
        // Transactions
        'BroadcastTransaction' => '\Adshares\Ads\Entity\Transaction\BroadcastTransaction',
        'ConnectionTransaction' => '\Adshares\Ads\Entity\Transaction\ConnectionTransaction',
        'EmptyTransaction' => '\Adshares\Ads\Entity\Transaction\EmptyTransaction',
        'KeyTransaction' => '\Adshares\Ads\Entity\Transaction\KeyTransaction',
        'LogAccountTransaction' => '\Adshares\Ads\Entity\Transaction\LogAccountTransaction',
        'NetworkTransaction' => '\Adshares\Ads\Entity\Transaction\NetworkTransaction',
        'SendManyTransaction' => '\Adshares\Ads\Entity\Transaction\SendManyTransaction',
        'SendManyTransactionWire' => '\Adshares\Ads\Entity\Transaction\SendManyTransactionWire',
        'SendOneTransaction' => '\Adshares\Ads\Entity\Transaction\SendOneTransaction',
        'StatusTransaction' => '\Adshares\Ads\Entity\Transaction\StatusTransaction',
    ];

    /**
     * @param string $type
     * @param string $className
     */
    public static function setEntityClass(string $type, string $className): void
    {
        if (!array_key_exists($type, self::$entityMap)) {
            throw new AdsException(sprintf('Cannot find entity type "%s"', $type));
        }

        self::$entityMap[$type] = $className;
    }

    /**
     * @param array $map
     */
    public static function setEntityMap(array $map): void
    {
        foreach ($map as $type => $className) {
            self::setEntityClass($type, $className);
        }
    }

    /**
     * @param  string $type
     * @param  array  $data
     * @return mixed
     */
    public static function create(string $type, array $data = [])
    {
        if (!array_key_exists($type, self::$entityMap)) {
            throw new AdsException(sprintf('Cannot find entity class for "%s"', $type));
        }

        return self::$entityMap[$type]::createFromRawData($data);
    }

    /**
     * @param  array $data
     * @return Account
     */
    public static function createAccount(array $data = []): Account
    {
        return self::create('Account', $data);
    }

    /**
     * @param  array $data
     * @return Block
     */
    public static function createBlock(array $data = []): Block
    {
        return self::create('Block', $data);
    }

    /**
     * @param  array $data
     * @return Broadcast
     */
    public static function createBroadcast(array $data = []): Broadcast
    {
        return self::create('Broadcast', $data);
    }

    public static function createMessage(array $data = []): Message
    {
        return self::create('Message', $data);
    }

    /**
     * @param  array $data
     * @return NetworkTx
     */
    public static function createNetworkTx(array $data = []): NetworkTx
    {
        return self::create('NetworkTx', $data);
    }

    /**
     * @param  array $data
     * @return NewAccount
     */
    public static function createNewAccount(array $data = []): NewAccount
    {
        return self::create('NewAccount', $data);
    }

    /**
     * @param  array $data
     * @return Node
     */
    public static function createNode(array $data = []): Node
    {
        return self::create('Node', $data);
    }

    /**
     * @param array $data
     *
     * @return mixed
     *
     * @throws AdsException
     */
    public static function createTransaction(array $data = [])
    {
        switch ($data['type']) {
            case 'broadcast':
                $entity = self::create('BroadcastTransaction', $data);
                break;
            case 'account_created':
            case 'change_account_key':
            case 'change_node_key':
                $entity = self::create('KeyTransaction', $data);
                break;
            case 'connection':
                $entity = self::create('ConnectionTransaction', $data);
                break;
            case 'create_account':
            case 'create_node':
            case 'retrieve_funds':
                $entity = self::create('NetworkTransaction', $data);
                break;
            case 'log_account':
                $entity = self::create('LogAccountTransaction', $data);
                break;
            case 'send_many':
                $entity = self::create('SendManyTransaction', $data);
                break;
            case 'send_one':
                $entity = self::create('SendOneTransaction', $data);
                break;
            case 'set_account_status':
            case 'set_node_status':
            case 'unset_account_status':
            case 'unset_node_status':
                $entity = self::create('StatusTransaction', $data);
                break;
            case 'empty':
                $entity = self::create('EmptyTransaction', $data);
                break;
            default:
                throw new AdsException(sprintf('Unsupported transaction type "%s".', $data['type']));
        }

        return $entity;
    }

    /**
     * @param  array $data
     * @return Tx
     */
    public static function createTx(array $data = []): Tx
    {
        return self::create('Tx', $data);
    }
}
