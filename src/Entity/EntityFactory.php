<?php

namespace Adshares\Ads\Entity;

use Adshares\Ads\Entity\Transaction\AbstractTransaction;
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
        'Package' => '\Adshares\Ads\Entity\Package',
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
     * @return Package
     */
    public static function createPackage(array $data = []): Package
    {
        /* @var $entity Package */
        $entity = self::create('Package', $data);

        return $entity;
    }

    /**
     * @param array $data
     * @return AbstractTransaction
     */
    public static function createTransaction(array $data = []): AbstractTransaction
    {
        /* @var $entity AbstractTransaction */
        $entity = null;

        $type = $data['type'];
        if ('broadcast' === $type) {
            $entity = self::create('BroadcastTransaction', $data);
        } else if ('account_created' === $type || 'change_account_key' === $type || 'change_node_key' === $type) {
            $entity = self::create('KeyTransaction', $data);
        } else if ('connection' === $type) {
            $entity = self::create('ConnectionTransaction', $data);
        } else if ('create_account' === $type || 'create_node' === $type || 'retrieve_funds' === $type) {
            $entity = self::create('NetworkTransaction', $data);
        } else if ('log_account' === $type) {
            $entity = self::create('LogAccountTransaction', $data);
        } else if ('send_many' === $type) {
            $entity = self::create('SendManyTransaction', $data);
        } else if ('send_one' === $type) {
            $entity = self::create('SendOneTransaction', $data);
        } else if ('set_account_status' === $type || 'set_node_status' === $type
            || 'unset_account_status' === $type || 'unset_node_status' === $type) {
            $entity = self::create('StatusTransaction', $data);
        } else {
            //'empty' === $type
            $entity = self::create('EmptyTransaction', $data);
        }

        return $entity;
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
