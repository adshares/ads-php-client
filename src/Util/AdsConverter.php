<?php
/**
 * Copyright (C) 2018 Adshares sp. z. o.o.
 *
 * This file is part of ADS PHP Client
 *
 * ADS PHP Client is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ADS PHP Client is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ADS PHP Client.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace Adshares\Ads\Util;

/**
 * AdsConverter is utility class to convert ADS currency.
 *
 * @package Adshares\Ads\Util
 */
class AdsConverter
{
    /**
     * Converts Ads to clicks.
     *
     * @param mixed $amount
     * @return int
     */
    public static function adsToClicks($amount): int
    {
        $amountAsString = (string)$amount;
        if (strpos($amountAsString, '.') !== false) {
            $ar = explode('.', $amountAsString);
            $ar[1] = str_pad($ar[1], 11, '0');
            $amountAsString = implode($ar);
        } else {
            $amountAsString = $amountAsString . '00000000000';
        }
        return (int)$amountAsString;
    }

    /**
     * Converts clicks to Ads.
     *
     * @param int $amount
     * @return string
     */
    public static function clicksToAds($amount): string
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
