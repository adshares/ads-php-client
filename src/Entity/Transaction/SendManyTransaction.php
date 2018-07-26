<?php

namespace Adshares\Ads\Entity\Transaction;

use Adshares\Ads\Util\AdsConverter;

/**
 * Transaction type=<'send_many'>.
 *
 * @package Adshares\Ads\Entity\Transaction
 */
class SendManyTransaction extends AbstractTransaction
{
    /**
     * @var int
     */
    protected $msgId;

    /**
     * @var int
     */
    protected $node;

    /**
     * @var string
     */
    protected $senderAddress;

    /**
     * @var int
     */
    protected $senderFee;

    /**
     * @var string
     */
    protected $signature;

    /**
     * @var \DateTime
     */
    protected $time;

    /**
     * @var int
     */
    protected $user;

    /**
     * @var int
     */
    protected $wireCount;

    /**
     * Array of wires
     *
     * @var \Adshares\Ads\Entity\Transaction\SendManyTransactionWire[]
     */
    protected $wires;

    /**
     * @return int
     */
    public function getMsgId(): int
    {
        return $this->msgId;
    }

    /**
     * @return int
     */
    public function getNode(): int
    {
        return $this->node;
    }

    /**
     * @return string
     */
    public function getSenderAddress(): string
    {
        return $this->senderAddress;
    }

    /**
     * @return int
     */
    public function getSenderFee(): int
    {
        return $this->senderFee;
    }

    /**
     * @return string
     */
    public function getSignature(): string
    {
        return $this->signature;
    }

    /**
     * @return \DateTime
     */
    public function getTime(): \DateTime
    {
        return $this->time;
    }

    /**
     * @return int
     */
    public function getUser(): int
    {
        return $this->user;
    }

    /**
     * @return int
     */
    public function getWireCount(): int
    {
        return $this->wireCount;
    }

    /**
     * @return \Adshares\Ads\Entity\Transaction\SendManyTransactionWire[] Array of wires
     */
    public function getWires(): array
    {
        return $this->wires;
    }

    /**
     * @param string $name
     * @param array|mixed $value
     * @param \ReflectionClass|null $refClass
     * @return int|mixed
     */
    protected static function castProperty(string $name, $value, \ReflectionClass $refClass = null)
    {
        if ('senderFee' === $name) {
            return AdsConverter::adsToClicks($value);
        }

        return parent::castProperty($name, $value, $refClass);
    }
}
