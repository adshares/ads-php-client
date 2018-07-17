<?php

namespace Adshares\Ads\Entity;

use Adshares\Ads\Util\AdsConverter;

/**
 * Class Block
 *
 * @package Adshares\Ads\Entity
 */
class Block extends AbstractEntity
{

    /**
     *
     * @var int
     */
    protected $dividendBalance;

    /**
     *
     * @var bool
     */
    protected $dividendPay;

    /**
     *
     * @var string
     */
    protected $id;

    /**
     *
     * @var int
     */
    protected $messageCount;

    /**
     *
     * @var string
     */
    protected $minhash;

    /**
     *
     * @var string
     */
    protected $msghash;

    /**
     *
     * @var int
     */
    protected $nodeCount;

    /**
     *
     * @var array[Node]
     */
    protected $nodes;

    /**
     *
     * @var string
     */
    protected $nodhash;

    /**
     *
     * @var string
     */
    protected $nowhash;

    /**
     *
     * @var string
     */
    protected $oldhash;

    /**
     *
     * @var \DateTime
     */
    protected $time;

    /**
     *
     * @var string
     */
    protected $viphash;

    /**
     *
     * @var int
     */
    protected $voteNo;

    /**
     *
     * @var int
     */
    protected $voteTotal;

    /**
     *
     * @var int
     */
    protected $voteYes;

    /**
     *
     * @return int
     */
    public function getDividendBalance(): int
    {
        return $this->dividendBalance;
    }

    /**
     *
     * @return bool
     */
    public function isDividendPay(): bool
    {
        return $this->dividendPay;
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
     * @return int
     */
    public function getMessageCount(): int
    {
        return $this->messageCount;
    }

    /**
     *
     * @return string
     */
    public function getMinHash(): string
    {
        return $this->minhash;
    }

    /**
     *
     * @return string
     */
    public function getMsgHash(): string
    {
        return $this->msghash;
    }

    /**
     *
     * @return int
     */
    public function getNodeCount(): int
    {
        return $this->nodeCount;
    }

    /**
     *
     * @return array
     */
    public function getNodes(): array
    {
        return $this->nodes;
    }

    /**
     *
     * @return string
     */
    public function getNodHash(): string
    {
        return $this->nodhash;
    }

    /**
     *
     * @return string
     */
    public function getNowHash(): string
    {
        return $this->nowhash;
    }

    /**
     *
     * @return string
     */
    public function getOldHash(): string
    {
        return $this->oldhash;
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
    public function getVipHash(): string
    {
        return $this->viphash;
    }

    /**
     *
     * @return int
     */
    public function getVoteNo(): int
    {
        return $this->voteNo;
    }

    /**
     *
     * @return int
     */
    public function getVoteTotal(): int
    {
        return $this->voteTotal;
    }

    /**
     *
     * @return int
     */
    public function getVoteYes(): int
    {
        return $this->voteYes;
    }

    /**
     * @inheritdoc
     */
    protected static function castProperty(string $name, $value, \ReflectionClass $refClass = null)
    {
        if ("dividendBalance" === $name) {
            return AdsConverter::adsToClicks($value);
        } else {
            return parent::castProperty($name, $value, $refClass);
        }
    }
}
