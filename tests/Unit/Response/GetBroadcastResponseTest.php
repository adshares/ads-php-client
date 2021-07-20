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

use Adshares\Ads\Entity\Broadcast;
use Adshares\Ads\Entity\Tx;
use Adshares\Ads\Response\GetBroadcastResponse;
use Adshares\Ads\Tests\Unit\Raw;
use DateTime;
use PHPUnit\Framework\TestCase;

class GetBroadcastResponseTest extends TestCase
{
    public function testGetBroadcastFromRaw(): void
    {
        $response = new GetBroadcastResponse($this->getRawData());
        $time = new DateTime();
        $time->setTimestamp(1532351072);
        $this->assertEquals($time, $response->getCurrentBlockTime());
        $time->setTimestamp(1532351040);
        $this->assertEquals($time, $response->getPreviousBlockTime());
        $this->assertEquals('5B55D240', $response->getBlockId());
        $this->assertContains($response->getLogFile(), ['archive', 'new']);

        $this->assertInstanceOf(Tx::class, $response->getTx());
        $broadcasts = $response->getBroadcast();
        $this->assertCount(1, $broadcasts);
        foreach ($broadcasts as $broadcast) {
            $this->assertInstanceOf(Broadcast::class, $broadcast);
        }
        $this->assertEquals(1, $response->getBroadcastCount());
    }

    /**
     * @return string[][][]
     */
    private function getRawData(): array
    {
        return json_decode(Raw::getBroadcast(), true);
    }
}
