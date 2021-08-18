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

use Adshares\Ads\Exception\AdsException;
use Adshares\Ads\Util\AdsConverter;
use PHPUnit\Framework\TestCase;

class AdsConverterTest extends TestCase
{
    public function testToClicks(): void
    {
        $entries = [
            [123.456, 12345600000000],
            ['123.45', 12345000000000],
            [456, 45600000000000],
            [-101.234, -10123400000000],
            ['-100.00000000000', -10000000000000],
            [-101, -10100000000000],
            [68.21675673135469, 6821675673135],
            [68.21675673135769, 6821675673135],
            [38758206, 3875820600000000000],
            ['38758206.00000000000', 3875820600000000000],
            ['-38758206.00000000000', -3875820600000000000],
            ['38758205.99999999999', 3875820599999999999],
            ['-38758205.99999999999', -3875820599999999999],
            [4.5e+2, 45000000000000],
            [4.5e-2, 4500000000],
            ['38758200.19999999921', 3875820019999999921],
            ['-38758200.19999999921', -3875820019999999921],
            [0.00000000001, 1],
            [1e-11, 1],
        ];
        foreach ($entries as $entry) {
            $this->assertEquals($entry[1], AdsConverter::adsToClicks($entry[0]));
        }
    }

    public function testInvalidToClicks(): void
    {
        $entries = [
            '123,45',
            '123.45.678',
            '12345.',
            '.12345',
            '4.5e+2',
            'foo',
            '12345o',
            '38758206.00001',
            '38758206.00000000001',
            '-38758206.00000000001',
            '38758207',
            '3875820600',
        ];
        foreach ($entries as $entry) {
            try {
                AdsConverter::adsToClicks($entry);
                $this->fail(
                    sprintf(
                        'Failed asserting that exception of type "%s" is thrown for %s.',
                        AdsException::class,
                        $entry
                    )
                );
            } catch (AdsException $exception) {
                $this->assertTrue(true);
            }
        }
    }

    public function testToAds(): void
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
