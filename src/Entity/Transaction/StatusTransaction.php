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
 * Transaction type=<'set_account_status', 'set_node_status', 'unset_account_status', 'unset_node_status'>.
 *
 * @package Adshares\Ads\Entity\Transaction
 */
class StatusTransaction extends AbstractTransaction
{
    use GetSenderAddressTrait;
    use GetTargetAddressTrait;

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
     * @var int
     */
    protected $status;

    /**
     * @var int
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
     * @return int
     */
    public function getNode(): int
    {
        return $this->node;
    }

    /**
     * @return string
     */
    public function getSignature(): string
    {
        return $this->signature;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getTargetNode(): int
    {
        return $this->targetNode;
    }

    /**
     * @return string
     */
    public function getTargetNodeId(): string
    {
        return sprintf('%04X', $this->targetNode);
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
