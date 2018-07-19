<?php

namespace Adshares\Ads\Entity;

/**
 * @package Adshares\Ads\Entity
 */
class Message extends AbstractEntity
{
    /**
     * @var string block id
     */
    protected $blockId;

    /**
     * @var string message hash
     */
    protected $hash;

    /**
     * @var int length
     */
    protected $length;

    /**
     * @var string message id
     */
    protected $messageId;

    /**
     * @var int node ordinal number
     */
    protected $node;

    /**
     * @var \DateTime
     */
    protected $time;

    /**
     * @return string block id
     */
    public function getBlockId(): string
    {
        return $this->blockId;
    }

    /**
     * @return string message hash
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return int length
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @return string message id
     */
    public function getMessageId(): string
    {
        return $this->messageId;
    }

    /**
     * @return string node id
     */
    public function getNodeId(): string
    {
        return sprintf('%04X', $this->node);
    }

    /**
     * @return \DateTime
     */
    public function getTime(): \DateTime
    {
        return $this->time;
    }
}
