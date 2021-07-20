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

namespace Adshares\Ads\Command;

use Adshares\Ads\Util\AdsConverter;

class SendOneCommand extends AbstractTransactionCommand
{
    /**
     * Address to which funds will be transferred
     *
     * @var string
     */
    private $address;

    /**
     * Transfer amount in clicks
     *
     * @var int
     */
    private $amount;

    /**
     * Transfer message, 32 bytes hexadecimal string without leading 0x (64 characters)
     *
     * @var null|string
     */
    private $message;

    /**
     * SendOneCommand constructor.
     *
     * @param string      $address address to which funds will be transferred
     * @param int         $amount  transfer amount in clicks
     * @param null|string $message transfer message, 32 bytes hexadecimal string without leading 0x (64 characters)
     */
    public function __construct(string $address, int $amount, ?string $message = null)
    {
        $this->address = $address;
        $this->amount = $amount;
        $this->message = $message;
    }

    /**
     * Returns command name.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'send_one';
    }

    /**
     * Returns command specific attributes.
     *
     * @return array
     */
    public function getAttributes(): array
    {
        $attributes['address'] = $this->address;
        $attributes['amount'] = AdsConverter::clicksToAds($this->amount);
        if ($this->message) {
            $attributes['message'] = $this->message;
        }
        return $attributes;
    }
}
