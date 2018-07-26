<?php

namespace Adshares\Ads\Command;

abstract class AbstractTransactionCommand extends AbstractCommand implements TransactionInterface
{
    /**
     * Hash of transaction sender account
     *
     * @var null|string
     */
    protected $lastHash;

    /**
     * Number of last sent message from transaction sender account
     *
     * @var null|int
     */
    protected $lastMsid;

    /**
     * Transaction sender address
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
     * Transaction timestamp
     *
     * @var null|int
     */
    protected $timestamp;

    /**
     * @return null|string Hash of transaction sender account
     */
    public function getLastHash(): ?string
    {
        return $this->lastHash;
    }

    /**
     * @param string $lastHash Hash of transaction sender account
     */
    public function setLastHash(string $lastHash): void
    {
        $this->lastHash = $lastHash;
    }

    /**
     * @return null|int Number of last sent message from transaction sender account
     */
    public function getLastMsid(): ?int
    {
        return $this->lastMsid;
    }

    /**
     * @param int $lastMsid Number of last sent message from transaction sender account
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
     * @param null|string $sender Transaction sender address
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
     * @return int|null Transaction timestamp
     */
    public function getTimestamp(): ?int
    {
        return $this->timestamp;
    }

    /**
     * @param int|null $timestamp Transaction timestamp
     */
    public function setTimestamp(?int $timestamp): void
    {
        $this->timestamp = $timestamp;
    }
}
