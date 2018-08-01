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

namespace Adshares\Ads\Tests\E2E;

use Adshares\Ads\AdsClient;
use Adshares\Ads\Driver\CliDriver;
use Adshares\Ads\Driver\CommandError;
use Adshares\Ads\Exception\CommandException;

class BlocksTest extends \PHPUnit\Framework\TestCase
{
    private $address = '0001-00000000-9B6F';
    private $secret = 'BB3425F914CA9F661CA6F3B908E07092B5AFB7F2FDAE2E94EDE12C83207CA743';
    private $host = '10.69.3.43';
    private $port = 9001;

    public function testGetBlockIds()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $attempt = 0;
        $attemptMax = 10;
        while ($attempt < $attemptMax) {
            try {
                $response = $client->getBlockIds();
                $blockCount = $response->getUpdatedBlocks();
                if (0 === $blockCount) {
                    break;
                }
                $blocks = $response->getBlockIds();
                $this->assertCount($blockCount, $blocks);
            } catch (CommandException $ce) {
                $this->assertEquals(CommandError::GET_SIGNATURE_UNAVAILABLE, $ce->getCode());
                sleep(4);
            }
            $attempt++;
        }
        $this->assertLessThan($attemptMax, $attempt, 'Didn\'t update blocks in expected attempts.');
    }

    public function testGetBlockIdsWithInvalidTime()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $this->expectException(CommandException::class);
        $this->expectExceptionCode(CommandError::NO_BLOCK_IN_SPECIFIED_RANGE);
        $client->getBlockIds('10000000', '10000033');
    }
}
