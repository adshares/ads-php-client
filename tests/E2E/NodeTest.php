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
use Adshares\Ads\Driver\CliDriver;
use Adshares\Ads\Driver\CommandError;
use Adshares\Ads\Exception\CommandException;

class NodeTest extends \PHPUnit\Framework\TestCase
{
    private $address = '0001-00000000-9B6F';
    private $secret = 'BB3425F914CA9F661CA6F3B908E07092B5AFB7F2FDAE2E94EDE12C83207CA743';
    private $host = '10.69.3.43';
    private $port = 9001;

    public function testGetBlock()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

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

    public function testGetBlockWithInvalidTime()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $this->expectException(CommandException::class);
        $this->expectExceptionCode(CommandError::GET_BLOCK_INFO_UNAVAILABLE);
        $client->getBlock('10000000');
    }

    public function testGetAccounts()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $response = $client->getAccounts('0001');
        $accounts = $response->getAccounts();
        $this->assertGreaterThan(0, count($accounts));
    }

    public function testGetAccountsFromBlock()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $response = $client->getAccounts('0001');
        $blockTime = dechex($response->getPreviousBlockTime()->getTimestamp());
        $accounts = $response->getAccounts();
        $response2 = $client->getAccounts('0001', $blockTime);
        $accounts2 = $response2->getAccounts();

        $this->assertEquals($accounts2, $accounts);
    }
}
