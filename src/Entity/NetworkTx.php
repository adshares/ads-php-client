<?php

namespace Adshares\Ads\Entity;

/**
 * NetworkTx from getTransaction.
 * @package Adshares\Ads\Entity
 */
class NetworkTx extends AbstractEntity
{

    /**
     * @var \DateTime
     */
    protected $blockId;

    /**
     * @var array[string]
     */
    protected $hashPath;

    /**
     * @var int
     */
    protected $hashPathLen;

    /**
     * @var string
     */
    protected $hexstring;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var int
     */
    protected $len;

    /**
     * @var int
     */
    protected $nodeId;

    /**
     * @var int
     */
    protected $nodeMsid;

    /**
     * @var int
     */
    protected $position;

    /**
     * @return \DateTime
     */
    public function getBlockId(): \DateTime
    {
        return $this->blockId;
    }

    /**
     * @return array
     */
    public function getHashPath(): array
    {
        return $this->hashPath;
    }

    /**
     * @return int
     */
    public function getHashPathLen(): int
    {
        return $this->hashPathLen;
    }

    /**
     * @return string
     */
    public function getHexstring(): string
    {
        return $this->hexstring;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getLen(): int
    {
        return $this->len;
    }

    /**
     * @return int
     */
    public function getNodeId(): int
    {
        return $this->nodeId;
    }

    /**
     * @return int
     */
    public function getNodeMsid(): int
    {
        return $this->nodeMsid;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }
}
