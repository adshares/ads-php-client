<?php

namespace Adshares\Ads\Entity;

/**
 * @package Adshares\Ads\Entity
 */
class Message extends AbstractEntity
{
    /**
     * Block id
     *
     * @var string
     */
    protected $blockId;

    /**
     * Message hash
     *
     * @var string
     */
    protected $hash;

    /**
     * Length
     *
     * @var int
     */
    protected $length;

    /**
     * Message id
     *
     * @var string
     */
    protected $messageId;

    /**
     * Node ordinal number
     *
     * @var int
     */
    protected $node;

    /**
     * @var \DateTime
     */
    protected $time;

    /**
     * @return string Block id
     */
    public function getBlockId(): string
    {
        return $this->blockId;
    }

    /**
     * @return string Message hash
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return int Length
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @return string Message id
     */
    public function getMessageId(): string
    {
        return $this->messageId;
    }

    /**
     * @return string Node id
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
