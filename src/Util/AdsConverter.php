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

namespace Adshares\Ads\Util;

use Adshares\Ads\Exception\AdsException;

/**
 * AdsConverter is utility class to convert ADS currency.
 *
 * @package Adshares\Ads\Util
 */
class AdsConverter
{
    public const TOTAL_SUPPLY = 3875820600000000000;

    /**
     * Converts Ads to clicks.
     *
     * @param  mixed $amount
     * @return int
     */
    public static function adsToClicks($amount): int
    {
        $amountAsString = is_string($amount) ? $amount : sprintf('%.12f', $amount);
        if (!is_numeric($amount) || !preg_match('/^-?[0-9]+(\.[0-9]+)?$/', $amountAsString)) {
            throw new AdsException(sprintf('Invalid ADS amount "%s"', $amount));
        }
        if (strpos($amountAsString, '.') !== false) {
            $ar = explode('.', $amountAsString);
            $ar[1] = str_pad(substr($ar[1], 0, 11), 11, '0');
            $amountAsString = implode($ar);
        } else {
            $amountAsString = $amountAsString . '00000000000';
        }
        $clicks = (int)$amountAsString;
        if ($clicks > self::TOTAL_SUPPLY || $clicks < -self::TOTAL_SUPPLY) {
            throw new AdsException(sprintf('The amount "%s" exceeds total ADS amount', $amount));
        }
        return $clicks;
    }

    /**
     * Converts clicks to Ads.
     *
     * @param  int $amount
     * @return string
     */
    public static function clicksToAds(int $amount): string
    {
        $amountAsString = (string)$amount;
        $isNegativeValue = false;
        if ('-' === $amountAsString[0]) {
            $isNegativeValue = true;
            // cut minus sign from negative value
            $amountAsString = substr($amountAsString, 1, strlen($amountAsString));
        }
        //add leading zeros
        $amountAsString = str_pad($amountAsString, 12, '0', STR_PAD_LEFT);
        // insert decimal separator
        $amountAsString = substr_replace($amountAsString, '.', strlen($amountAsString) - 11, 0);
        if ($isNegativeValue) {
            // prepend minus sign for negative value
            $amountAsString = '-' . $amountAsString;
        }
        return $amountAsString;
    }
}
