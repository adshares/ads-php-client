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

namespace Adshares\Ads\Tests\E2E;

use Adshares\Ads\AdsClient;
use Adshares\Ads\Command\BroadcastCommand;
use Adshares\Ads\Driver\CliDriver;
use Adshares\Ads\Driver\CommandError;
use Adshares\Ads\Entity\Broadcast;
use Adshares\Ads\Exception\CommandException;
use Adshares\Ads\Response\GetBroadcastResponse;

class BroadcastTest extends \PHPUnit\Framework\TestCase
{
    const BLOCK_TIME_SECONDS = 32;

    private $address = '0001-00000000-9B6F';
    private $secret = 'BB3425F914CA9F661CA6F3B908E07092B5AFB7F2FDAE2E94EDE12C83207CA743';
    private $host = '10.69.3.43';
    private $port = 9001;

    public function testBroadcastWithoutTime()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $response = $client->getBroadcast();
        $this->assertEquals(0, $response->getBroadcastCount());
    }

    public function testBroadcast()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $message = strtoupper('12ab');
        $command = new BroadcastCommand($message);
        $response = $client->runTransaction($command);
        $this->assertEquals($this->address, $response->getAccount()->getAddress());

        $txId = $response->getTx()->getId();

        $this->assertInternalType('string', $txId);

        $blockTime = $response->getCurrentBlockTime();
        $blockTime = $blockTime->getTimestamp();

        $delay = 0;
        $delayMax = 2;
        $nextBlockAttempt = 0;
        $nextBlockAttemptMax = 2;

        /* @var GetBroadcastResponse $getBroadcastResponse */
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

        /* @var Broadcast $broadcast */
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
