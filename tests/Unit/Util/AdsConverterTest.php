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

namespace Adshares\Ads\Tests\Unit\Util;

use Adshares\Ads\Util\AdsConverter;

class AdsConverterTest extends \PHPUnit\Framework\TestCase
{
    public function testToClicks()
    {
        $entries = [
            [123.456, 12345600000000],
            ['123.45', 12345000000000],
            [456, 45600000000000],
            [-101.234, -10123400000000],
            ['-100.00000000000', -10000000000000],
            [-101, -10100000000000],
        ];
        foreach ($entries as $entry) {
            $this->assertEquals($entry[1], AdsConverter::adsToClicks($entry[0]));
        }
    }

    public function testToAds()
    {
        $entries = [
            [12345678901, '0.12345678901'],
            [999, '0.00000000999'],
            [543543543543, '5.43543543543'],
            [-10000000000000, '-100.00000000000'],
            [-100, '-0.00000000100'],
        ];
        foreach ($entries as $entry) {
            $this->assertEquals($entry[1], AdsConverter::clicksToAds($entry[0]));
        }
    }
}
