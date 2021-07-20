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

namespace Adshares\Ads\Tests\E2E;

use Adshares\Ads\Driver\CommandError;
use Adshares\Ads\Exception\CommandException;
use PHPUnit\Framework\TestCase;

class BlocksTest extends TestCase
{
    public function testGetBlockIds()
    {
        $client = new TestAdsClient();

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
        $client = new TestAdsClient();

        $this->expectException(CommandException::class);
        $this->expectExceptionCode(CommandError::NO_BLOCK_IN_SPECIFIED_RANGE);
        $client->getBlockIds('10000000', '10000033');
    }
}
