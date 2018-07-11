<?php

namespace Adshares\Ads\Entity;

use Adshares\Ads\Util\AdsConverter;

/**
 *
 * @package Adshares\Ads\Entity
 */
class Account extends AbstractEntity
{
    /**
     *
     * @var string
     */
    protected $address;

    /**
     *
     * @var int
     */
    protected $balance;

    /**
     *
     * @var string
     */
    protected $hash;

    /**
     *
     * @var int
     */
    protected $id;

    /**
     *
     * @var \DateTime
     */
    protected $localChange;

    /**
     *
     * @var int
     */
    protected $msid;

    /**
     *
     * @var int
     */
    protected $node;

    /**
     *
     * @var int
     */
    protected $pairedId;

    /**
     *
     * @var int
     */
    protected $pairedNode;

    /**
     *
     * @var string
     */
    protected $publicKey;

    /**
     *
     * @var \DateTime
     */
    protected $remoteChange;

    /**
     *
     * @var int
     */
    protected $status;

    /**
     *
     * @var \DateTime
     */
    protected $time;

    /**
     *
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     *
     * @return int
     */
    public function getBalance(): int
    {
        return $this->balance;
    }

    /**
     *
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     *
     * @return \DateTime
     */
    public function getLocalChange(): \DateTime
    {
        return $this->localChange;
    }

    /**
     *
     * @return int
     */
    public function getMsid(): int
    {
        return $this->msid;
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
     * @return int
     */
    public function getPairedId(): int
    {
        return $this->pairedId;
    }

    /**
     *
     * @return int
     */
    public function getPairedNode(): int
    {
        return $this->pairedNode;
    }

    /**
     *
     * @return string
     */
    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    /**
     *
     * @return \DateTime
     */
    public function getRemoteChange(): \DateTime
    {
        return $this->remoteChange;
    }

    /**
     *
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
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
     * @inheritdoc
     */
    protected static function castProperty(string $name, $value, \ReflectionClass $refClass = null)
    {
        if ("balance" === $name) {
            return AdsConverter::adsToClicks($value);
        } else {
            return parent::castProperty($name, $value, $refClass);
        }
    }
}
