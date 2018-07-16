<?php

namespace Adshares\Ads\Entity\Transaction;

use Adshares\Ads\Entity\AbstractEntity;

/**
 * AbstractTransaction included in getPackage response.
 *
 * @package Adshares\Ads\Entity
 */
abstract class AbstractTransaction extends AbstractEntity
{
    /**
     * @var string
     */
    protected $id;

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
    public function getId(): string
    {
        return $this->id;
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
