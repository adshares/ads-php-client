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

use Adshares\Ads\Util\AdsConverter;
use DateTimeInterface;
use ReflectionClass;

/**
 * Transaction type=<'send_one'>.
 *
 * @package Adshares\Ads\Entity\Transaction
 */
class SendOneTransaction extends AbstractTransaction
{
    /**
     * @var int
     */
    protected $amount;

    /**
     * @var string
     */
    protected $message;

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
    protected $senderAddress;

    /**
     * @var int
     */
    protected $senderFee;

    /**
     * @var string
     */
    protected $signature;

    /**
     * @var string
     */
    protected $targetAddress;

    /**
     * @var int
     */
    protected $targetNode;

    /**
     * @var int
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
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

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
        return $this->senderAddress;
    }

    /**
     * @return int
     */
    public function getSenderFee(): int
    {
        return $this->senderFee;
    }

    /**
     * @return string
     */
    public function getTargetAddress(): string
    {
        return $this->targetAddress;
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
     * @return int
     */
    public function getTargetUser(): int
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

    /**
     * @return string
     */
    public function getSignature(): string
    {
        return $this->signature;
    }

    protected static function castProperty(string $name, $value, ReflectionClass $refClass = null)
    {
        switch ($name) {
            case 'amount':
            case 'senderFee':
                return AdsConverter::adsToClicks($value);
            default:
                return parent::castProperty($name, $value, $refClass);
        }
    }
}
