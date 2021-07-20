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

use Adshares\Ads\Command\BroadcastCommand;
use Adshares\Ads\Driver\CommandError;
use Adshares\Ads\Entity\Broadcast;
use Adshares\Ads\Exception\CommandException;
use Adshares\Ads\Response\GetBroadcastResponse;
use PHPUnit\Framework\TestCase;

class BroadcastTest extends TestCase
{
    private const BLOCK_TIME_SECONDS = 32;

    public function testBroadcastWithoutTime(): void
    {
        $client = new TestAdsClient();

        $response = $client->getBroadcast();
        $this->assertEquals(0, $response->getBroadcastCount());
    }

    public function testBroadcast(): void
    {
        $client = new TestAdsClient();

        $message = strtoupper('12ab');
        $command = new BroadcastCommand($message);
        $response = $client->runTransaction($command);
        $this->assertEquals($client->getAddress(), $response->getAccount()->getAddress());

        $txId = $response->getTx()->getId();

        $this->assertIsString($txId);

        $blockTime = $response->getCurrentBlockTime();
        $blockTime = $blockTime->getTimestamp();

        $delay = 0;
        $delayMax = 2;
        $nextBlockAttempt = 0;
        $nextBlockAttemptMax = 2;

        /** @var GetBroadcastResponse $getBroadcastResponse */
        $getBroadcastResponse = null;
        $broadcastCount = 0;
        sleep(self::BLOCK_TIME_SECONDS);
        do {
            try {
                $from = dechex($blockTime);
                $getBroadcastResponse = $client->getBroadcast($from);
                $broadcastCount = $getBroadcastResponse->getBroadcastCount();
                if ($broadcastCount === 0) {
                    $this->assertLessThan($nextBlockAttemptMax, $nextBlockAttempt);
                    $blockTime += self::BLOCK_TIME_SECONDS;
                    ++$nextBlockAttempt;
                }
            } catch (CommandException $ce) {
                $this->assertEquals(CommandError::BROADCAST_NOT_READY, $ce->getCode());
                $this->assertLessThan($delayMax, $delay);
                sleep(self::BLOCK_TIME_SECONDS);
                ++$delay;
            }
        } while (0 === $broadcastCount);

        /** @var Broadcast $broadcast */
        $broadcast = null;
        if (null !== $getBroadcastResponse) {
            $broadcasts = $getBroadcastResponse->getBroadcast();
            $broadcast = array_shift($broadcasts);
        }
        $this->assertInstanceOf(Broadcast::class, $broadcast);
        if (null !== $broadcast) {
            $this->assertEquals($message, $broadcast->getMessage());
        }
    }
}
