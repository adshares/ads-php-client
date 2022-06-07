<?php

/**
 * Copyright (c) 2018-2022 Adshares sp. z o.o.
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

class SendManyCommand extends AbstractTransactionCommand
{
    /**
     * Array of wires. Each entry is pair: account address => amount in clicks.
     *                     Example: ['0001-00000000-XXXX'=>200,'0001-00000001-XXXX'=>10]
     *
     * @var int[]
     */
    private $wires;

    /**
     * @param int[] $wires array of wires. Each entry is pair: account address => amount in clicks.
     *                     Example: ['0001-00000000-XXXX'=>200,'0001-00000001-XXXX'=>10]
     */
    public function __construct(array $wires)
    {
        $this->wires = $wires;
    }

    public function getName(): string
    {
        return 'send_many';
    }

    public function getAttributes(): array
    {
        $attributes = [];
        foreach ($this->wires as $address => $amount) {
            $attributes['wires'][$address] = AdsConverter::clicksToAds($amount);
        }

        return $attributes;
    }
}
