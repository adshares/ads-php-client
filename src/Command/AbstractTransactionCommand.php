<?php

namespace Adshares\Ads\Command;

abstract class AbstractTransactionCommand extends AbstractCommand implements TransactionInterface
{

    /**
     * @var null|string
     */
    protected $lastHash;

    /**
     * @var null|int
     */
    protected $lastMsid;

    /**
     * @var null|string
     */
    protected $sender;

    /**
     * @var null|string
     */
    protected $signature;

    /**
     * @var null|int
     */
    protected $timestamp;

    /**
     * @return null|string
     */
    public function getLastHash(): ?string
    {
        return $this->lastHash;
    }

    /**
     * @param string $lastHash
     */
    public function setLastHash(string $lastHash): void
    {
        $this->lastHash = $lastHash;
    }

    /**
     * @return null|int
     */
    public function getLastMsid(): ?int
    {
        return $this->lastMsid;
    }

    /**
     * @param int $lastMsid
     */
    public function setLastMsid(int $lastMsid): void
    {
        $this->lastMsid = $lastMsid;
    }

    /**
     * @return null|string
     */
    public function getSender(): ?string
    {
        return $this->sender;
    }

    /**
     * @param null|string $sender
     */
    public function setSender(?string $sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @return null|string
     */
    public function getSignature(): ?string
    {
        return $this->signature;
    }

    /**
     * @param null|string $signature
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
