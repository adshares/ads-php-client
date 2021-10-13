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

namespace Adshares\Ads\Tests\Unit\Util;

use Adshares\Ads\Util\AdsNormalizer;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class AdsNormalizerTest extends TestCase
{
    public function testNormalizeAddressValid(): void
    {
        $address = '0001000000001234';
        $address = AdsNormalizer::normalizeAddress($address);
        $this->assertEquals('0001-00000000-1234', $address);
    }

    public function testNormalizeAddressWithoutChecksum(): void
    {
        $address = '000100000000XXXX';
        $address = AdsNormalizer::normalizeAddress($address);
        $this->assertEquals('0001-00000000-9B6F', $address);
    }

    public function testNormalizeAddressInvalid(): void
    {
        $address = 'XXXXXXXX';
        $this->expectException(RuntimeException::class);
        AdsNormalizer::normalizeAddress($address);
    }

    public function testNormalizeTxidValid(): void
    {
        $txid = '0001000000010001';
        $txid = AdsNormalizer::normalizeTxid($txid);
        $this->assertEquals('0001:00000001:0001', $txid);
    }

    public function testNormalizeTxidInvalid(): void
    {
        $address = '000100000000XXXX';
        $this->expectException(RuntimeException::class);
        AdsNormalizer::normalizeTxid($address);
    }
}
