<?php

namespace Adshares\Ads\Entity\Transaction;

/**
 * Transaction type=<'connection'>.
 *
 * @package Adshares\Ads\Entity\Transaction
 */
class ConnectionTransaction extends AbstractTransaction
{
    /**
     * @var string
     */
    protected $ipAddress;

    /**
     * @var int
     */
    protected $port;

    /**
     * @var string
     */
    protected $version;

    /**
     * @return string
     */
    public function getIpAddress(): string
    {
        return $this->ipAddress;
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
    public function getVersion(): string
    {
        return $this->version;
    }
}
