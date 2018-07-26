<?php

namespace Adshares\Ads\Entity\Transaction;

use Adshares\Ads\Entity\AbstractEntity;
use Adshares\Ads\Util\AdsConverter;

/**
 * @package Adshares\Ads\Entity\Transaction
 */
class SendManyTransactionWire extends AbstractEntity
{
    /**
     * @var int
     */
    protected $amount;

    /**
     * @var string
     */
    protected $targetAddress;

    /**
     * @var int
     */
    protected $targetNode;

    /**
     * @var int
     */
    protected $targetUser;

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function getTargetNode(): int
    {
        return $this->targetNode;
    }

    /**
     * @return int
     */
    public function getTargetUser(): int
    {
        return $this->targetUser;
    }

    /**
     * @return string
     */
    public function getTargetAddress(): string
    {
        return $this->targetAddress;
    }

    /**
     * @param string $name
     * @param array|mixed $value
     * @param \ReflectionClass|null $refClass
     * @return int|mixed
     */
    protected static function castProperty(string $name, $value, \ReflectionClass $refClass = null)
    {
        if ('amount' === $name) {
            return AdsConverter::adsToClicks($value);
        }

        return parent::castProperty($name, $value, $refClass);
    }
}
