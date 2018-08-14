<?php
/**
 * Copyright (C) 2018 Adshares sp. z. o.o.
 *
 * This file is part of ADS PHP Client
 *
 * ADS PHP Client is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ADS PHP Client is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ADS PHP Client.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace Adshares\Ads\Entity\Transaction;

use Adshares\Ads\Util\AdsChecksumGenerator;

/**
 * Transaction type=<'create_account', 'create_node', 'retrieve_funds'>.
 *
 * @package Adshares\Ads\Entity\Transaction
 */
class NetworkTransaction extends AbstractTransaction
{
    /**
     * @var int
     */
    protected $msgId;

    /**
     * @var int
     */
    protected $node;

    /**
     * @var string
     */
    protected $signature;

    /**
     * @var null|int
     */
    protected $targetNode;

    /**
     * @var null|int
     */
    protected $targetUser;

    /**
     * @var \DateTime
     */
    protected $time;

    /**
     * @var int
     */
    protected $user;

    /**
     * @return int
     */
    public function getMsgId(): int
    {
        return $this->msgId;
    }

    /**
     * @return int
     */
    public function getNode(): int
    {
        return $this->node;
    }

    /**
     * @return string
     */
    public function getSenderAddress(): string
    {
        return sprintf(
            '%04X-%08X-%s',
            $this->node,
            $this->user,
            AdsChecksumGenerator::getAccountChecksum($this->node, $this->user)
        );
    }

    /**
     * @return string
     */
    public function getSignature(): string
    {
        return $this->signature;
    }

    /**
     * @return null|string
     */
    public function getTargetAddress(): ?string
    {
        if (null === $this->targetNode || null === $this->targetUser) {
            return null;
        }

        return sprintf(
            '%04X-%08X-%s',
            $this->targetNode,
            $this->targetUser,
            AdsChecksumGenerator::getAccountChecksum($this->targetNode, $this->targetUser)
        );
    }

    /**
     * @return int|null
     */
    public function getTargetNode(): ?int
    {
        return $this->targetNode;
    }

    /**
     * @return int|null
     */
    public function getTargetUser(): ?int
    {
        return $this->targetUser;
    }

    /**
     * @return \DateTime
     */
    public function getTime(): \DateTime
    {
        return $this->time;
    }

    /**
     * @return int
     */
    public function getUser(): int
    {
        return $this->user;
    }
}
