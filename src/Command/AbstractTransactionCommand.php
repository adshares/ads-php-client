<?php

namespace Adshares\Ads\Command;

abstract class AbstractTransactionCommand extends AbstractCommand implements TransactionInterface
{
    /**
     * Hash
     *
     * @var null|string
     */
    protected $lastHash;

    /**
     * Number of last message
     *
     * @var null|int
     */
    protected $lastMsid;

    /**
     * Sender address
     *
     * @var null|string
     */
    protected $sender;

    /**
     * Transaction signature
     *
     * @var null|string
     */
    protected $signature;

    /**
     * @var null|int
     */
    protected $timestamp;

    /**
     * @return null|string Hash
     */
    public function getLastHash(): ?string
    {
        return $this->lastHash;
    }

    /**
     * @param string $lastHash Hash
     */
    public function setLastHash(string $lastHash): void
    {
        $this->lastHash = $lastHash;
    }

    /**
     * @return null|int Number of last message
     */
    public function getLastMsid(): ?int
    {
        return $this->lastMsid;
    }

    /**
     * @param int $lastMsid Number of last message
     */
    public function setLastMsid(int $lastMsid): void
    {
        $this->lastMsid = $lastMsid;
    }

    /**
     * @return null|string Sender address
     */
    public function getSender(): ?string
    {
        return $this->sender;
    }

    /**
     * @param null|string $sender Sender address
     */
    public function setSender(?string $sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @return null|string Transaction signature
     */
    public function getSignature(): ?string
    {
        return $this->signature;
    }

    /**
     * @param null|string $signature Transaction signature
     */
    public function setSignature(?string $signature): void
    {
        $this->signature = $signature;
    }

    /**
     * @return int|null
     */
    public function getTimestamp(): ?int
    {
        return $this->timestamp;
    }

    /**
     * @param int|null $timestamp
     */
    public function setTimestamp(?int $timestamp): void
    {
        $this->timestamp = $timestamp;
    }
}
