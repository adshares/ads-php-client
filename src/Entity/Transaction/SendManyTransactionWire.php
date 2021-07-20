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

use Adshares\Ads\Entity\AbstractEntity;
use Adshares\Ads\Util\AdsConverter;
use ReflectionClass;

/**
 * @package Adshares\Ads\Entity\Transaction
 */
class SendManyTransactionWire extends AbstractEntity
{
    /**
     * @var int
     */
    protected $amount;

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
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
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
     * @return string
     */
    public function getTargetAddress(): string
    {
        return $this->targetAddress;
    }

    protected static function castProperty(string $name, $value, ReflectionClass $refClass = null)
    {
        if ('amount' === $name) {
            return AdsConverter::adsToClicks($value);
        }

        return parent::castProperty($name, $value, $refClass);
    }
}
