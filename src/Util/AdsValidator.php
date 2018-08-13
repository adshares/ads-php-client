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
 * AdsValidator is utility class responsible for validation of ADS ids.
 *
 * @package Adshares\Ads\Util
 */
class AdsValidator
{
    /**
     * Generates CRC16 checksum.
     *
     * @param string $hexChars string
     * @return int checksum
     */
    private static function crc16(string $hexChars): int
    {
        $chars = hex2bin($hexChars);
        if ($chars) {
            $crc = 0x1D0F;
            for ($i = 0; $i < strlen($chars); $i++) {
                $x = ($crc >> 8) ^ ord($chars[$i]);
                $x ^= $x >> 4;
                $crc = (($crc << 8) ^ ($x << 12) ^ ($x << 5) ^ ($x)) & 0xFFFF;
            }
        } else {
            $crc = 0;
        }
        return $crc;
    }

    /**
     * Generate checksum for account.
     *
     * @param int $node node number
     * @param int $user account number in node
     * @return string
     */
    public static function getAccountChecksum(int $node, int $user): string
    {
        return sprintf('%04X', self::crc16(sprintf('%04X%08X', $node, $user)));
    }

    /**
     * Checks, if account address is in proper format.
     *
     * @param string $address account address
     * @return bool true if address is valid, false otherwise
     */
    public static function isAccountAddressValid(string $address): bool
    {
        return 1 == preg_match('/^[0-9a-fA-F]{4}-[0-9a-fA-F]{8}-([0-9a-fA-F]{4}|XXXX)$/', $address);
    }

    /**
     * Checks, if message id is valid.
     *
     * @param string $messageId message id
     * @return bool true if id is valid, false otherwise
     */
    public static function isMessageIdValid(string $messageId): bool
    {
        return 1 == preg_match('/^[0-9a-fA-F]{4}:[0-9a-fA-F]{8}$/', $messageId);
    }

    /**
     * Checks, if transaction id is valid.
     *
     * @param string $txid transaction id
     * @return bool true if id is valid, false otherwise
     */
    public static function isTransactionIdValid(string $txid): bool
    {
        return 1 == preg_match('/^[0-9a-fA-F]{4}:[0-9a-fA-F]{8}:[0-9a-fA-F]{4}$/', $txid);
    }
}
