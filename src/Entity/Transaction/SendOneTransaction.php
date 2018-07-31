<?php
/**
 * Copyright (C) 2018 Adshares sp. z. o.o.
 *
 * This file is part of PHP ADS Client
 *
 * PHP ADS Client is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * PHP ADS Client is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with PHP ADS Client.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace Adshares\Ads\Entity\Transaction;

use Adshares\Ads\Util\AdsConverter;

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
     * @return int
     */
    public function getTargetUser(): int
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

    /**
     * @return string
     */
    public function getSignature(): string
    {
        return $this->signature;
    }

    /**
     * @param string $name
     * @param array|mixed $value
     * @param \ReflectionClass|null $refClass
     * @return int|mixed
     */
    protected static function castProperty(string $name, $value, \ReflectionClass $refClass = null)
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
