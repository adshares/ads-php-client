<?php

namespace Adshares\Ads\Entity;

use Adshares\Ads\Util\AdsConverter;

/**
 * Tx is common element of response.
 *
 * @package Adshares\Ads\Entity
 */
class Tx extends AbstractEntity
{
    /**
     * Class fields, which contain money amount.
     */
    const MONEY_FIELDS = ["deduct", "fee"];

    /**
     *
     * @var null|int
     */
    protected $accountMsid;

    /**
     *
     * @var null|string
     */
    protected $accountHashin;

    /**
     *
     * @var null|string
     */
    protected $accountHashout;

    /**
     *
     * @var string
     */
    protected $data;

    /**
     *
     * @var null|int
     */
    protected $deduct;

    /**
     *
     * @var null|int
     */
    protected $fee;

    /**
     *
     * @var null|string
     */
    protected $id;

    /**
     *
     * @var null|int
     */
    protected $nodeMpos;

    /**
     *
     * @var null|int
     */
    protected $nodeMsid;

    /**
     *
     * @return int|null
     */
    public function getAccountMsid(): ?int
    {
        return $this->accountMsid;
    }

    /**
     *
     * @return null|string
     */
    public function getAccountHashin(): ?string
    {
        return $this->accountHashin;
    }

    /**
     *
     * @return null|string
     */
    public function getAccountHashout(): ?string
    {
        return $this->accountHashout;
    }

    /**
     *
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     *
     * @return int|null
     */
    public function getDeduct(): ?int
    {
        return $this->deduct;
    }

    /**
     *
     * @return int|null
     */
    public function getFee(): ?int
    {
        return $this->fee;
    }

    /**
     *
     * @return null|string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     *
     * @return int|null
     */
    public function getNodeMpos(): ?int
    {
        return $this->nodeMpos;
    }

    /**
     *
     * @return int|null
     */
    public function getNodeMsid(): ?int
    {
        return $this->nodeMsid;
    }

    protected static function castProperty(string $name, $value, \ReflectionClass $refClass = null)
    {
        if (in_array($name, self::MONEY_FIELDS)) {
            return AdsConverter::adsToClicks($value);
        } else {
            return parent::castProperty($name, $value, $refClass);
        }
    }
}
