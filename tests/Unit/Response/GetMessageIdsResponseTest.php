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

use Adshares\Ads\Entity\Tx;
use Adshares\Ads\Response\GetMessageIdsResponse;
use Adshares\Ads\Tests\Unit\Raw;
use DateTime;
use PHPUnit\Framework\TestCase;

class GetMessageIdsResponseTest extends TestCase
{
    public function testGetMessageIdsFromRaw(): void
    {
        $response = new GetMessageIdsResponse($this->getRawData());
        $time = new DateTime();
        $time->setTimestamp(1532077312);
        $this->assertEquals($time, $response->getCurrentBlockTime());
        $time->setTimestamp(1532077280);
        $this->assertEquals($time, $response->getPreviousBlockTime());
        $this->assertEquals(7, $response->getMessageCount());
        $this->assertCount(7, $response->getMessageIds());
        $this->assertEquals('5B51A3E0', $response->getBlockId());

        $this->assertInstanceOf(Tx::class, $response->getTx());
    }

    public function testGetMessageIdsFromRawEmpty(): void
    {
        $response = new GetMessageIdsResponse($this->getRawDataEmpty());
        $time = new DateTime();
        $time->setTimestamp(1532077216);
        $this->assertEquals($time, $response->getCurrentBlockTime());
        $time->setTimestamp(1532077184);
        $this->assertEquals($time, $response->getPreviousBlockTime());
        $this->assertEquals(0, $response->getMessageCount());
        $this->assertCount(0, $response->getMessageIds());
        $this->assertEquals('5B51A3C0', $response->getBlockId());

        $this->assertInstanceOf(Tx::class, $response->getTx());
    }

    /**
     * @return string[][]
     */
    private function getRawData(): array
    {
        return json_decode(Raw::getMessageIds(), true);
    }

    /**
     * @return string[][]
     */
    private function getRawDataEmpty(): array
    {
        return json_decode(
            '{
            "current_block_time": "1532077216",
            "previous_block_time": "1532077184",
            "tx": {
                "data": "19010002000000BCA4515BC0A3515B",
                "signature": "1ABBC13782EEEB9BBBC48F51DB1163361241C66ACAE4AEDE53DD1208FAFAF89E7'
            . '6DEBFA3567287BF684EFDC3468057BF69A6F9F2DD77EBE9A518518CDD185A00",
                "time": "1532077244"
            },
            "block_time_hex": "5B51A3C0",
            "block_time": "1532076992",
            "msghash": "0000000000000000000000000000000000000000000000000000000000000000",
            "message_count": "0",
            "confirmed": "yes"
        }',
            true
        );
    }
}
