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

namespace Adshares\Ads\Entity\Transaction;

use DateTimeInterface;

/**
 * Transaction type=<'account_created', 'change_account_key', 'change_node_key'>.
 *
 * @package Adshares\Ads\Entity\Transaction
 */
class KeyTransaction extends AbstractTransaction
{
    use GetSenderAddressTrait;
    use GetTargetAddressTrait;

    /**
     * @var int
     */
    protected $msgId;

    /**
     * @var null|string
     */
    protected $newPublicKey;

    /**
     * @var int
     */
    protected $node;

    /**
     * @var null|string
     */
    protected $oldPublicKey;

    /**
     * @var null|string
     */
    protected $publicKey;

    /**
     * @var null|string
     */
    protected $publicKeySignature;

    /**
     * @var null|string
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
     * @var DateTimeInterface
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
     * @return null|string
     */
    public function getNewPublicKey(): ?string
    {
        return $this->newPublicKey;
    }

    /**
     * @return int
     */
    public function getNode(): int
    {
        return $this->node;
    }

    /**
     * @return null|string
     */
    public function getOldPublicKey(): ?string
    {
        return $this->oldPublicKey;
    }

    /**
     * @return null|string
     */
    public function getPublicKey(): ?string
    {
        return $this->publicKey;
    }

    /**
     * @return null|string
     */
    public function getPublicKeySignature(): ?string
    {
        return $this->publicKeySignature;
    }

    /**
     * @return null|string
     */
    public function getSignature(): ?string
    {
        return $this->signature;
    }

    /**
     * @return int|null
     */
    public function getTargetNode(): ?int
    {
        return $this->targetNode;
    }

    /**
     * @return string|null
     */
    public function getTargetNodeId(): ?string
    {
        return is_int($this->targetNode) ? sprintf('%04X', $this->targetNode) : null;
    }

    /**
     * @return int|null
     */
    public function getTargetUser(): ?int
    {
        return $this->targetUser;
    }

    /**
     * @return DateTimeInterface
     */
    public function getTime(): DateTimeInterface
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
