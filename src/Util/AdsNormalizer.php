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

namespace Adshares\Ads\Util;

use Adshares\Ads\Exception\AdsException;

/**
 * AdsNormalizer is utility class to remove unwanted chars from ADS ids. This class contains legacy code from AdsClient.
 *
 * @package Adshares\Ads\Util
 */
class AdsNormalizer
{
    /**
     * @param  string $address account address
     * @return string normalized account address
     */
    public static function normalizeAddress(string $address): string
    {
        /** @var string $x */
        $x = preg_replace('/[^0-9A-FX]+/', '', strtoupper($address));
        if (strlen($x) != 16) {
            throw new AdsException('Invalid address');
        }
        $nodeId = substr($x, 0, 4);
        $userId = substr($x, 4, 8);
        $checksum = substr($x, 12, 4);
        if ('XXXX' === $checksum) {
            $checksum = AdsChecksumGenerator::getAccountChecksum((int)hexdec($nodeId), (int)hexdec($userId));
        }
        return sprintf("%s-%s-%s", $nodeId, $userId, $checksum);
    }

    /**
     * @param  string $txid transaction id
     * @return string normalized transaction id
     */
    public static function normalizeTxid(string $txid): string
    {
        /** @var string $x */
        $x = preg_replace('/[^0-9A-F]+/', '', strtoupper($txid));
        if (strlen($x) != 16) {
            throw new AdsException('Invalid transaction id');
        }
        return sprintf("%s:%s:%s", substr($x, 0, 4), substr($x, 4, 8), substr($x, 12, 4));
    }
}
