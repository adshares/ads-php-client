<?php
/**
 * Copyright (C) 2018 Adshares sp. z. o.o.
 *
 * This file is part of PHP ADS Client
 *
 * PHP ADS Client is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * PHP ADS Client is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with PHP ADS Client.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace Adshares\Ads\Tests\Unit\Util;

use Adshares\Ads\Util\AdsNormalizer;

class AdsNormalizerTest extends \PHPUnit\Framework\TestCase
{
    public function testNormalizeAddressValid()
    {
        $address = '000100000000XXXX';
        $address = AdsNormalizer::normalizeAddress($address);
        $this->assertEquals('0001-00000000-XXXX', $address);
    }

    public function testNormalizeAddressInvalid()
    {
        $address = 'XXXXXXXX';
        $this->expectException(\RuntimeException::class);
        AdsNormalizer::normalizeAddress($address);
    }

    public function testNormalizeTxidValid()
    {
        $txid = '0001000000010001';
        $txid = AdsNormalizer::normalizeTxid($txid);
        $this->assertEquals('0001:00000001:0001', $txid);
    }

    public function testNormalizeTxidInvalid()
    {
        $address = '000100000000XXXX';
        $this->expectException(\RuntimeException::class);
        AdsNormalizer::normalizeTxid($address);
    }
}
