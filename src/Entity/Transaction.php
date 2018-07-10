<?php

namespace Adshares\Ads\Entity;

/**
 * Transaction included in getPackage response.
 *
 * @package Adshares\Ads\Entity
 */
class Transaction extends AbstractEntity
{

    /**
     *
     * @var array[string]
     */
    protected $data;

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
    protected $size;

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

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
        $entity->data = $data;

        return $entity;
    }
}
