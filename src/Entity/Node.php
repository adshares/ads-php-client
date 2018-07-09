<?php

namespace Adshares\Ads\Entity;

use Adshares\Ads\Util\AdsConverter;


/**
 * Node from getBlock.
 * @package Adshares\Ads\Entity
 */
class Node extends AbstractEntity
{
    /**
     * @var int
     */
    protected $accountCount;

    /**
     * @var int
     */
    protected $balance;

    /**
     * @var string
     */
    protected $hash;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $ipv4;

    /**
     * @var string
     */
    protected $message_hash;
    /**
     * @var int
     */
    protected $msid;

    /**
     * @var \DateTime
     */
    protected $mtim;

    /**
     * @var int
     */
    protected $port;

    /**
     * @var string
     */
    protected $publicKey;

    /**
     * @var int
     */
    protected $status;

    /**
     * @return int
     */
    public function getAccountCount(): int
    {
        return $this->accountCount;
    }

    /**
     * @return int
     */
    public function getBalance(): int
    {
        return $this->balance;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
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
    public function getIpv4(): string
    {
        return $this->ipv4;
    }

    /**
     * @return string
     */
    public function getMessageHash(): string
    {
        return $this->message_hash;
    }

    /**
     * @return int
     */
    public function getMsid(): int
    {
        return $this->msid;
    }

    /**
     * @return \DateTime
     */
    public function getMtim(): \DateTime
    {
        return $this->mtim;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    protected static function castProperty(string $name, $value, \ReflectionClass $refClass = null)
    {
        if ("balance" === $name) {
            return AdsConverter::adsToClicks($value);
        } else {
            return parent::castProperty($name, $value, $refClass);
        }
    }
}