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
 * Tx is common element of response.
 *
 * @package Adshares\Ads\Entity
 */
class Tx extends AbstractEntity
{
    /**
     * Class fields, which contain money amount.
     */
    private const MONEY_FIELDS = ['deduct', 'fee'];

    /**
     * Number of account transactions
     *
     * @var null|int
     */
    protected $accountMsid;

    /**
     * Last account transaction hash used in this transaction as input for signing
     *
     * @var null|string
     */
    protected $accountHashin;

    /**
     * New account transaction hash after signing the new transaction
     *
     * @var null|string
     */
    protected $accountHashout;

    /**
     * Complete transaction byte stream (data) as hexadecimal string
     *
     * @var string
     */
    protected $data;

    /**
     * Cost of the transaction (deduction from balance)
     *
     * @var null|int
     */
    protected $deduct;

    /**
     * Transaction fee (part of deduct)
     *
     * @var null|int
     */
    protected $fee;

    /**
     * Transaction id. Transaction identifier is not null if the transaction was submitted to the node
     * and is scheduled for broadcast on the network.
     *
     * @var null|string
     */
    protected $id;

    /**
     * Transaction position in message
     *
     * @var null|int
     */
    protected $nodeMpos;

    /**
     * Node message id
     *
     * @var null|int
     */
    protected $nodeMsid;

    /**
     * Transaction signature as hexadecimal string
     *
     * @var string
     */
    protected $signature;

    /**
     * @var DateTimeInterface
     */
    protected $time;

    /**
     * @return int|null Number of account transactions
     */
    public function getAccountMsid(): ?int
    {
        return $this->accountMsid;
    }

    /**
     * @return null|string Last account transaction hash used in this transaction as input for signing
     */
    public function getAccountHashin(): ?string
    {
        return $this->accountHashin;
    }

    /**
     * @return null|string New account transaction hash after signing the new transaction
     */
    public function getAccountHashout(): ?string
    {
        return $this->accountHashout;
    }

    /**
     * @return string Complete transaction byte stream (data) as hexadecimal string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @return int|null Cost of the transaction (deduction from balance)
     */
    public function getDeduct(): ?int
    {
        return $this->deduct;
    }

    /**
     * @return int|null Transaction fee (part of deduct)
     */
    public function getFee(): ?int
    {
        return $this->fee;
    }

    /**
     * @return null|string Transaction id. Transaction identifier is not null if the transaction was submitted
     * to the node and is scheduled for broadcast on the network.
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return int|null Transaction position in message
     */
    public function getNodeMpos(): ?int
    {
        return $this->nodeMpos;
    }

    /**
     * @return int|null Node message id
     */
    public function getNodeMsid(): ?int
    {
        return $this->nodeMsid;
    }

    /**
     * @return string Transaction signature as hexadecimal string
     */
    public function getSignature(): string
    {
        return $this->signature;
    }

    /**
     * @return DateTimeInterface
     */
    public function getTime(): DateTimeInterface
    {
        return $this->time;
    }

    protected static function castProperty(string $name, $value, ReflectionClass $refClass = null)
    {
        if (in_array($name, self::MONEY_FIELDS)) {
            return AdsConverter::adsToClicks($value);
        }

        return parent::castProperty($name, $value, $refClass);
    }
}
