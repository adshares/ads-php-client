<?php

namespace Adshares\Ads\Entity;

use Adshares\Ads\Exception\AdsException;

class EntityFactory
{
    /**
     * @var array[string]
     */
    private static $entityMap = [
        'Account' => '\Adshares\Ads\Entity\Account',
        'Block' => '\Adshares\Ads\Entity\Block',
        'Broadcast' => '\Adshares\Ads\Entity\Broadcast',
        'NetworkTx' => '\Adshares\Ads\Entity\NetworkTx',
        'Node' => '\Adshares\Ads\Entity\Node',
        'Tx' => '\Adshares\Ads\Entity\Tx',
        'Txn' => '\Adshares\Ads\Entity\Txn',
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
     * @param string $type
     * @param array $data
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
     * @param array $data
     * @return Account
     */
    public static function createAccount(array $data = []): Account
    {
        /* @var $entity Account */
        $entity = self::create('Account', $data);

        return $entity;
    }

    /**
     * @param array $data
     * @return Block
     */
    public static function createBlock(array $data = []): Block
    {
        /* @var $entity Block */
        $entity = self::create('Block', $data);

        return $entity;
    }

    /**
     * @param array $data
     * @return Broadcast
     */
    public static function createBroadcast(array $data = []): Broadcast
    {
        /* @var $entity Broadcast */
        $entity = self::create('Broadcast', $data);

        return $entity;
    }

    /**
     * @param array $data
     * @return NetworkTx
     */
    public static function createNetworkTx(array $data = []): NetworkTx
    {
        /* @var $entity NetworkTx */
        $entity = self::create('NetworkTx', $data);

        return $entity;
    }

    /**
     * @param array $data
     * @return Node
     */
    public static function createNode(array $data = []): Node
    {
        /* @var $entity Node */
        $entity = self::create('Node', $data);

        return $entity;
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
                return self::create('BroadcastTransaction', $data);
            case 'account_created':
            case 'change_account_key':
            case 'change_node_key':
                return self::create('KeyTransaction', $data);
            case 'connection':
                return self::create('ConnectionTransaction', $data);
            case 'create_account':
            case 'create_node':
            case 'retrieve_funds':
                return self::create('NetworkTransaction', $data);
            case 'log_account':
                return self::create('LogAccountTransaction', $data);
            case 'send_many':
                return self::create('SendManyTransaction', $data);
            case 'send_one':
                return self::create('SendOneTransaction', $data);
            case 'set_account_status':
            case 'set_node_status':
            case 'unset_account_status':
            case 'unset_node_status':
                return self::create('StatusTransaction', $data);
            case 'empty':
                return self::create('EmptyTransaction', $data);
            default:
                throw new AdsException(sprintf('Unsupported transaction type "%s".', $data['type']));
        }
    }

    /**
     * @param array $data
     * @return Tx
     */
    public static function createTx(array $data = []): Tx
    {
        /* @var $entity Tx */
        $entity = self::create('Tx', $data);

        return $entity;
    }

    /**
     * @param array $data
     * @return Txn
     */
    public static function createTxn(array $data = []): Txn
    {
        /* @var $entity Txn */
        $entity = self::create('Txn', $data);

        return $entity;
    }
}
