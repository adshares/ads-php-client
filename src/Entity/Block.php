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
     * Dividend
     *
     * @var int
     */
    protected $dividendBalance;

    /**
     * Dividend block flag. It is true if this is the first block in the dividend period, false otherwise
     *
     * @var bool
     */
    protected $dividendPay;

    /**
     * Block id
     *
     * @var string
     */
    protected $id;

    /**
     * Number of messages in block
     *
     * @var int
     */
    protected $messageCount;

    /**
     * Input block hash
     *
     * @var string
     */
    protected $minHash;

    /**
     * Hash of messages
     *
     * @var string
     */
    protected $msgHash;

    /**
     * Number of nodes (includes technical node 0000)
     *
     * @var int
     */
    protected $nodeCount;

    /**
     * Array of nodes
     *
     * @var array[Node]
     */
    protected $nodes;

    /**
     * Hash of nodes
     *
     * @var string
     */
    protected $nodHash;

    /**
     * Block hash
     *
     * @var string
     */
    protected $nowHash;

    /**
     * Old block hash
     *
     * @var string
     */
    protected $oldHash;

    /**
     * @var \DateTime Block time
     */
    protected $time;

    /**
     * Hash of vip public keys
     *
     * @var string
     */
    protected $vipHash;

    /**
     * Forking signatures
     *
     * @var int
     */
    protected $voteNo;

    /**
     * Total number of signatures
     *
     * @var int
     */
    protected $voteTotal;

    /**
     * Confirming signatures
     *
     * @var int
     */
    protected $voteYes;

    /**
     * @return int Dividend
     */
    public function getDividendBalance(): int
    {
        return $this->dividendBalance;
    }

    /**
     * @return bool Dividend block flag. It is true if this is the first block in the dividend period, false otherwise
     */
    public function isDividendPay(): bool
    {
        return $this->dividendPay;
    }

    /**
     * @return string Block id
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int Number of messages in block
     */
    public function getMessageCount(): int
    {
        return $this->messageCount;
    }

    /**
     * @return string Input block hash
     */
    public function getMinHash(): string
    {
        return $this->minHash;
    }

    /**
     * @return string Hash of messages
     */
    public function getMsgHash(): string
    {
        return $this->msgHash;
    }

    /**
     * @return int Number of nodes (includes technical node 0000)
     */
    public function getNodeCount(): int
    {
        return $this->nodeCount;
    }

    /**
     * @return array Array of nodes
     */
    public function getNodes(): array
    {
        return $this->nodes;
    }

    /**
     * @return string Hash of nodes
     */
    public function getNodHash(): string
    {
        return $this->nodHash;
    }

    /**
     * @return string Block hash
     */
    public function getNowHash(): string
    {
        return $this->nowHash;
    }

    /**
     * @return string Old block hash
     */
    public function getOldHash(): string
    {
        return $this->oldHash;
    }

    /**
     * @return \DateTime Block time
     */
    public function getTime(): \DateTime
    {
        return $this->time;
    }

    /**
     * @return string Hash of vip public keys
     */
    public function getVipHash(): string
    {
        return $this->vipHash;
    }

    /**
     * @return int Forking signatures
     */
    public function getVoteNo(): int
    {
        return $this->voteNo;
    }

    /**
     * @return int Total number of signatures
     */
    public function getVoteTotal(): int
    {
        return $this->voteTotal;
    }

    /**
     * @return int Confirming signatures
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

    public static function createFromRawData(array $data): EntityInterface
    {
        $entity = new static();
        $entity->fillWithRawData($data);
        $entity->minHash = $data['minhash'];
        $entity->msgHash = $data['msghash'];
        $entity->nodHash = $data['nodhash'];
        $entity->nowHash = $data['nowhash'];
        $entity->oldHash = $data['oldhash'];
        $entity->vipHash = $data['viphash'];

        return $entity;
    }
}
