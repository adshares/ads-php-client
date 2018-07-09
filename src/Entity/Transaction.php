<?php

namespace Adshares\Ads\Entity;

/**
 * Transaction from getMessage.
 *
 * @package Adshares\Ads\Entity
 */
class Transaction extends AbstractEntity
{

    /**
     *
     * @var string
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $type;

    /**
     *
     * @var int
     */
    protected $messageLength;
    /**
     *
     * @var int
     */
    protected $size;

    /**
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     *
     * @return int
     */
    public function getMessageLength(): int
    {
        return $this->messageLength;
    }

    /**
     *
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param array $data
     * @return Transaction
     */
    public static function createFromRaw(array $data): Transaction
    {
        $entity = new Transaction();
        $entity->fillWithRawData($data);

        return $entity;
    }
}
