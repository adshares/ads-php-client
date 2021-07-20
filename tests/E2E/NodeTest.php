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

class NodeTest extends TestCase
{
    public function testGetBlock(): void
    {
        $client = new TestAdsClient();

        $response = null;
        $attempt = 0;
        $attemptMax = 10;
        while ((null === $response) && ($attempt < $attemptMax)) {
            try {
                $response = $client->getBlock();
            } catch (CommandException $ce) {
                $this->assertEquals(CommandError::GET_BLOCK_INFO_UNAVAILABLE, $ce->getCode());
                $attempt++;
                sleep(4);
            }
        }
        $this->assertNotNull($response, 'Didn\'t receive block data in expected attempts.');
        if (null !== $response) {
            $block = $response->getBlock();
            $this->assertNotEquals(0, $block->getMessageCount());
            $this->assertGreaterThan(1, count($block->getNodes()));
        }
    }

    public function testGetBlockWithInvalidTime(): void
    {
        $client = new TestAdsClient();

        $this->expectException(CommandException::class);
        $this->expectExceptionCode(CommandError::GET_BLOCK_INFO_UNAVAILABLE);
        $client->getBlock('10000000');
    }

    public function testGetAccounts(): void
    {
        $client = new TestAdsClient();

        $response = $client->getAccounts('0001');
        $accounts = $response->getAccounts();
        $this->assertGreaterThan(0, count($accounts));
    }

    public function testGetAccountsFromBlock(): void
    {
        $client = new TestAdsClient();

        $response = $client->getAccounts('0001');
        $blockTime = dechex($response->getPreviousBlockTime()->getTimestamp());
        $accounts = $response->getAccounts();
        $response2 = $client->getAccounts('0001', $blockTime);
        $accounts2 = $response2->getAccounts();

        $this->assertEquals($accounts2, $accounts);
    }
}
