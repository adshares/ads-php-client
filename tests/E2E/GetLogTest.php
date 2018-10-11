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

class GetLogTest extends \PHPUnit\Framework\TestCase
{
    public function testGetLog()
    {
        $client = AdsClientSingleton::getInstance();

        $response = $client->getLog();

        $account = $response->getAccount();
        $this->assertEquals(AdsClientSingleton::getAddress(), $account->getAddress());

        $log = $response->getLog();
        $this->assertGreaterThan(0, count($log));
    }

    public function testGetLogInFuture()
    {
        $client = AdsClientSingleton::getInstance();

        $from = new \DateTime();
        $from->setTimestamp(2000000000);
        $response = $client->getLog($from);

        $account = $response->getAccount();
        $this->assertEquals(AdsClientSingleton::getAddress(), $account->getAddress());

        $log = $response->getLog();
        $this->assertCount(0, $log);
    }
}
