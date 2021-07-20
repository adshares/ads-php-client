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
use DateTime;
use ReflectionClass;

/**
 * Transaction type=<'send_many'>.
 *
 * @package Adshares\Ads\Entity\Transaction
 */
class SendManyTransaction extends AbstractTransaction
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
     * @var DateTime
     */
    protected $time;

    /**
     * @var int
     */
    protected $user;

    /**
     * @var int
     */
    protected $wireCount;

    /**
     * Array of wires
     *
     * @var \Adshares\Ads\Entity\Transaction\SendManyTransactionWire[]
     */
    protected $wires;

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
    public function getSignature(): string
    {
        return $this->signature;
    }

    /**
     * @return DateTime
     */
    public function getTime(): DateTime
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
     * @return int
     */
    public function getWireCount(): int
    {
        return $this->wireCount;
    }

    /**
     * @return \Adshares\Ads\Entity\Transaction\SendManyTransactionWire[] Array of wires
     */
    public function getWires(): array
    {
        return $this->wires;
    }

    /**
     * @param  string                $name
     * @param  array|mixed           $value
     * @param  ReflectionClass|null $refClass
     * @return int|mixed
     */
    protected static function castProperty(string $name, $value, ReflectionClass $refClass = null)
    {
        if ('senderFee' === $name) {
            return AdsConverter::adsToClicks($value);
        }

        return parent::castProperty($name, $value, $refClass);
    }
}
