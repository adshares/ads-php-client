<?php

namespace Adshares\Ads\Entity;

use Adshares\Ads\Util\AdsConverter;

/**
 * Txn from getTransaction.
 *
 * @package Adshares\Ads\Entity
 */
class Txn extends AbstractEntity
{
    /**
     * Class fields, which contain money amount.
     */
    const MONEY_FIELDS = ["amount", "senderFee"];

    /**
     *
     * @var int
     */
    protected $amount;

    /**
     *
     * @var int
     */
    protected $destinationNode;

    /**
     *
     * @var int
     */
    protected $destinationUser;

    /**
     *
     * @var string
     */
    protected $message;

    /**
     *
     * @var int
     */
    protected $msg_id;

    /**
     *
     * @var int
     */
    protected $node;

    /**
     *
     * @var string;
     */
    protected $senderAddress;

    /**
     *
     * @var int
     */
    protected $senderFee;

    /**
     *
     * @var string;
     */
    protected $signature;

    /**
     *
     * @var string;
     */
    protected $targetAddress;

    /**
     *
     * @var \DateTime
     */
    protected $time;

    /**
     *
     * @var string;
     */
    protected $type;

    /**
     *
     * @var int
     */
    protected $user;

    /**
     *
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     *
     * @return int
     */
    public function getDestinationNode(): int
    {
        return $this->destinationNode;
    }

    /**
     *
     * @return int
     */
    public function getDestinationUser(): int
    {
        return $this->destinationUser;
    }

    /**
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     *
     * @return int
     */
    public function getMsgId(): int
    {
        return $this->msg_id;
    }

    /**
     *
     * @return int
     */
    public function getNode(): int
    {
        return $this->node;
    }

    /**
     *
     * @return string
     */
    public function getSenderAddress(): string
    {
        return $this->senderAddress;
    }

    /**
     *
     * @return int
     */
    public function getSenderFee(): int
    {
        return $this->senderFee;
    }

    /**
     *
     * @return string
     */
    public function getSignature(): string
    {
        return $this->signature;
    }

    /**
     *
     * @return string
     */
    public function getTargetAddress(): string
    {
        return $this->targetAddress;
    }

    /**
     *
     * @return \DateTime
     */
    public function getTime(): \DateTime
    {
        return $this->time;
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
    public function getUser(): int
    {
        return $this->user;
    }

    protected static function castProperty(string $name, $value, \ReflectionClass $refClass = null)
    {
        if (in_array($name, self::MONEY_FIELDS)) {
            return AdsConverter::adsToClicks($value);
        } else {
            return parent::castProperty($name, $value, $refClass);
        }
    }


    /**
     * @param array $data
     * @return Txn
     */
    public static function createFromRaw(array $data): Txn
    {
        $entity = new Txn();
        $entity->fillWithRawData($data);

        return $entity;
    }
}
