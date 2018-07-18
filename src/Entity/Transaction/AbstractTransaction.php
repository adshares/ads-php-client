<?php

namespace Adshares\Ads\Entity\Transaction;

use Adshares\Ads\Entity\AbstractEntity;

/**
 * AbstractTransaction is base class for all transactions included in getMessage response.
 *
 * @package Adshares\Ads\Entity
 */
abstract class AbstractTransaction extends AbstractEntity
{
    /**
     * @var string
     */
    protected $blockId;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $messageId;

    /**
     * @var string
     */
    protected $nodeId;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var int
     */
    protected $size;

    /**
     * @return string
     */
    public function getBlockId(): string
    {
        return $this->blockId;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMessageId(): string
    {
        return $this->messageId;
    }

    /**
     * @return string
     */
    public function getNodeId(): string
    {
        return $this->nodeId;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }
}
