<?php

namespace Adshares\Ads\Entity;

/**
 * NetworkTx from getTransaction.
 *
 * @package Adshares\Ads\Entity
 */
class NetworkTx extends AbstractEntity
{
    /**
     * Block id
     *
     * @var string
     */
    protected $blockId;

    /**
     * Block time
     *
     * @var \DateTime
     */
    protected $blockTime;

    /**
     * Hash path to block hash, array of string
     *
     * @var string[]
     */
    protected $hashpath;

    /**
     * Number of hashes in hash path (path to block hash)
     *
     * @var int
     */
    protected $hashpathSize;

    /**
     * Transaction data as hexadecimal string
     *
     * @var string
     */
    protected $data;

    /**
     * Transaction id
     *
     * @var string
     */
    protected $id;

    /**
     * Node ordinal number
     *
     * @var int
     */
    protected $node;

    /**
     * Number of last node message
     *
     * @var int
     */
    protected $nodeMsid;

    /**
     * Transaction position in node message
     *
     * @var int
     */
    protected $nodeMpos;

    /**
     * Size of the transaction data
     *
     * @var int
     */
    protected $size;

    /**
     * @return string Block id
     */
    public function getBlockId(): string
    {
        return $this->blockId;
    }

    /**
     * @return \DateTime Block time
     */
    public function getBlockTime(): \DateTime
    {
        return $this->blockTime;
    }

    /**
     * @return string[] Hash path to block hash, array of string
     */
    public function getHashpath(): array
    {
        return $this->hashpath;
    }

    /**
     * @return int Number of hashes in hash path (path to block hash)
     */
    public function getHashpathSize(): int
    {
        return $this->hashpathSize;
    }

    /**
     * @return string Transaction data as hexadecimal string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @return string Transaction id
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int Node ordinal number
     */
    public function getNode(): int
    {
        return $this->node;
    }

    /**
     * @return string Node id
     */
    public function getNodeId(): string
    {
        return sprintf('%04X', $this->node);
    }

    /**
     * @return int Number of last node message
     */
    public function getNodeMsid(): int
    {
        return $this->nodeMsid;
    }

    /**
     * @return int Transaction position in node message
     */
    public function getNodeMpos(): int
    {
        return $this->nodeMpos;
    }

    /**
     * @return int Size of the transaction data
     */
    public function getSize(): int
    {
        return $this->size;
    }
}
