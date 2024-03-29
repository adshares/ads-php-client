<?php

/**
 * Copyright (c) 2018-2021 Adshares sp. z o.o.
 *
 * This file is part of ADS PHP Client
 *
 * ADS PHP Client is free software: you can redistribute and/or modify it
 * under the terms of the GNU General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ADS PHP Client is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ADS PHP Client. If not, see <https://www.gnu.org/licenses/>
 */

namespace Adshares\Ads\Entity;

use Adshares\Ads\Util\AdsConverter;
use DateTimeInterface;
use ReflectionClass;

/**
 * Node from getBlock.
 *
 * @package Adshares\Ads\Entity
 */
class Node extends AbstractEntity
{
    /**
     * Number of accounts
     *
     * @var int
     */
    protected $accountCount;

    /**
     * Sum of account balances
     *
     * @var int
     */
    protected $balance;

    /**
     * Hash of accounts
     *
     * @var string
     */
    protected $hash;

    /**
     * Id
     *
     * @var string
     */
    protected $id;

    /**
     * IP address
     *
     * @var string
     */
    protected $ipv4;

    /**
     * Hash of last message
     *
     * @var string
     */
    protected $messageHash;

    /**
     * Number of last message
     *
     * @var int
     */
    protected $msid;

    /**
     * Time of last message
     *
     * @var DateTimeInterface
     */
    protected $mtim;

    /**
     * IP port (for peers, blockchain messaging)
     *
     * @var int
     */
    protected $port;

    /**
     * Public key
     *
     * @var string
     */
    protected $publicKey;

    /**
     * Status
     *
     * @var int
     */
    protected $status;

    /**
     * @return int Number of accounts
     */
    public function getAccountCount(): int
    {
        return $this->accountCount;
    }

    /**
     * @return int Sum of account balances
     */
    public function getBalance(): int
    {
        return $this->balance;
    }

    /**
     * @return string Hash of accounts
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return string Id
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string IP address
     */
    public function getIpv4(): string
    {
        return $this->ipv4;
    }

    /**
     * @return string Hash of last message
     */
    public function getMessageHash(): string
    {
        return $this->messageHash;
    }

    /**
     * @return int Number of last message
     */
    public function getMsid(): int
    {
        return $this->msid;
    }

    /**
     * @return DateTimeInterface Time of last message
     */
    public function getMtim(): DateTimeInterface
    {
        return $this->mtim;
    }

    /**
     * @return int IP port (for peers, blockchain messaging)
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @return string Public key
     */
    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    /**
     * @return int Status
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return bool true if node has been deleted, false otherwise
     */
    public function isStatusDeleted(): bool
    {
        return ($this->status & (1 << 0)) != 0;
    }

    /**
     * @return bool true if node is vip, false otherwise
     */
    public function isStatusVip(): bool
    {
        return ($this->status & (1 << 1)) != 0;
    }

    /**
     * @return bool true if node has most funds, false otherwise
     */
    public function isStatusMostFunds(): bool
    {
        return ($this->status & (1 << 2)) != 0;
    }

    protected static function castProperty(string $name, $value, ReflectionClass $refClass = null)
    {
        if ('balance' === $name) {
            return AdsConverter::adsToClicks($value);
        }

        return parent::castProperty($name, $value, $refClass);
    }
}
