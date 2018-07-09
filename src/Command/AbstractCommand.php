<?php

namespace Adshares\Ads\Command;

abstract class AbstractCommand implements CommandInterface
{

    /**
     * @var null|string
     */
    protected $lastHash;

    /**
     * @var null|string
     */
    protected $lastMessageId;

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
     * @return null|string
     */
    public function getLastMessageId(): ?string
    {
        return $this->lastMessageId;
    }

    /**
     * @param string $lastMessageId
     */
    public function setLastMessageId(string $lastMessageId): void
    {
        $this->lastMessageId = $lastMessageId;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return [];
    }
}
