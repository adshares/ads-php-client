<?php

namespace Adshares\Ads\Entity;

/**
 * @package Adshares\Ads\Entity
 */
class Message extends AbstractEntity
{
    /**
     * @var string
     */
    protected $blockId;

    /**
     * @var string
     */
    protected $hash;

    /**
     * @var int
     */
    protected $length;

    /**
     * @var string
     */
    protected $messageId;

    /**
     * @var string
     */
    protected $nodeId;

    /**
     * @var \DateTime
     */
    protected $time;

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
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
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
     * @return \DateTime
     */
    public function getTime(): \DateTime
    {
        return $this->time;
    }

    /**
     * @param array $data
     * @return EntityInterface
     */
    public static function createFromRawData(array $data): EntityInterface
    {
        $entity = new static();
        $entity->fillWithRawData($data);
        $entity->nodeId = sprintf("%04X", $data['node']);

        return $entity;
    }
}
