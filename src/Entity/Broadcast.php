<?php

namespace Adshares\Ads\Entity;

use Adshares\Ads\Util\AdsConverter;

/**
 * @package Adshares\Ads\Entity
 */
class Broadcast extends AbstractEntity
{
    /**
     * @var int
     */
    protected $account;

    /**
     * @var int
     */
    protected $accountMsid;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var \DateTime
     */
    protected $blockTime;

    /**
     * @var string
     */
    protected $data;

    /**
     * @var int
     */
    protected $fee;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $inputHash;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var int
     */
    protected $node;

    /**
     * @var int
     */
    protected $nodeMpos;

    /**
     * @var int
     */
    protected $nodeMsid;

    /**
     * @var string
     */
    protected $publicKey;

    /**
     * @var string
     */
    protected $signature;

    /**
     * @var \DateTime
     */
    protected $time;

    /**
     * true if verification passed, false if verification failed
     * @var boolean
     */
    protected $verify;

    /**
     * @return int
     */
    public function getAccount(): int
    {
        return $this->account;
    }

    /**
     * @return int
     */
    public function getAccountMsid(): int
    {
        return $this->accountMsid;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return \DateTime
     */
    public function getBlockTime(): \DateTime
    {
        return $this->blockTime;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @return int
     */
    public function getFee(): int
    {
        return $this->fee;
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
    public function getInputHash(): string
    {
        return $this->inputHash;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getNode(): int
    {
        return $this->node;
    }

    /**
     * @return int
     */
    public function getNodeMpos(): int
    {
        return $this->nodeMpos;
    }

    /**
     * @return int
     */
    public function getNodeMsid(): int
    {
        return $this->nodeMsid;
    }

    /**
     * @return string
     */
    public function getPublicKey(): string
    {
        return $this->publicKey;
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
     * @return bool true if verification passed, false if verification failed
     */
    public function isVerify(): bool
    {
        return $this->verify;
    }

    protected static function castProperty(string $name, $value, \ReflectionClass $refClass = null)
    {
        if ("fee" === $name) {
            return AdsConverter::adsToClicks($value);
        } else {
            return parent::castProperty($name, $value, $refClass);
        }
    }
}
