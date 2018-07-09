<?php

namespace Adshares\Ads\Command;

abstract class AbstractCommand implements CommandInterface
{

    /**
     *
     * @var null|string
     */
    protected $lastHash;

    /**
     *
     * @var null|int
     */
    protected $lastMessageId;

    /**
     *
     * @return null|string
     */
    public function getLastHash(): ?string
    {
        return $this->lastHash;
    }

    /**
     *
     * @param string $lastHash
     */
    public function setLastHash(string $lastHash): void
    {
        $this->lastHash = $lastHash;
    }

    /**
     * @return null|int
     */
    public function getLastMessageId(): ?int
    {
        return $this->lastMessageId;
    }

    /**
     *
     * @param int $lastMessageId
     */
    public function setLastMessageId(int $lastMessageId): void
    {
        $this->lastMessageId = $lastMessageId;
    }

    /**
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return [];
    }
}
