<?php
/**
 * Copyright (C) 2018 Adshares sp. z o.o.
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
 * along with ADS PHP Client.  If not, see <https://www.gnu.org/licenses/>
 */

namespace Adshares\Ads\Tests\Unit\Util;

use Adshares\Ads\Util\AdsChecksumGenerator;

class AdsAccountChecksumTest extends \PHPUnit\Framework\TestCase
{
    public function testAccountChecksum()
    {
        $this->assertEquals('9B6F', AdsChecksumGenerator::getAccountChecksum(1, 0));
        $this->assertEquals('AB0C', AdsChecksumGenerator::getAccountChecksum(1, 3));
        $this->assertEquals('2755', AdsChecksumGenerator::getAccountChecksum(16, 16));

        $this->assertNotEquals('8888', AdsChecksumGenerator::getAccountChecksum(2, 0));
    }
}
