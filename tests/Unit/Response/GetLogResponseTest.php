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

namespace Adshares\Ads\Tests\Unit\Response;

use Adshares\Ads\Entity\Account;
use Adshares\Ads\Entity\Tx;
use Adshares\Ads\Response\GetLogResponse;
use Adshares\Ads\Tests\Unit\Raw;

class GetLogResponseTest extends \PHPUnit\Framework\TestCase
{
    public function testGetLogFromRaw()
    {
        $rawDataArray = $this->getRawDataArray();
        foreach ($rawDataArray as $rawData) {
            /* @var GetLogResponse $response */
            $response = new GetLogResponse($rawData);
            $time = new \DateTime();
            $time->setTimestamp(1539173408);
            $this->assertEquals($time, $response->getCurrentBlockTime());
            $time->setTimestamp(1539173376);
            $this->assertEquals($time, $response->getPreviousBlockTime());

            $this->assertInstanceOf(Tx::class, $response->getTx());
            $this->assertInstanceOf(Account::class, $response->getAccount());
            $this->assertInternalType('array', $response->getLog());
        }
    }

    private function getRawDataArray(): array
    {
        return [json_decode(Raw::getLog(), true), json_decode(Raw::getLogEmpty(), true)];
    }
}
