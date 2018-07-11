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
        'Package' => '\Adshares\Ads\Entity\Package',
        'Transaction' => '\Adshares\Ads\Entity\Transaction',
        'Tx' => '\Adshares\Ads\Entity\Tx',
        'Txn' => '\Adshares\Ads\Entity\Txn',
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
     * @return Transaction
     */
    public static function createTransaction(array $data = []): Transaction
    {
        /* @var $entity Transaction */
        $entity = self::create('Transaction', $data);

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
