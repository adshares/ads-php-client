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

namespace Adshares\Ads\Tests\Unit\Entity;

use Adshares\Ads\Entity\EntityFactory;
use DateTime;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    public function testCreateFromRow(): void
    {
        $message = EntityFactory::createMessage($this->getRawData());

        $this->assertEquals('5B4F1D60', $message->getBlockId());
        $this->assertEquals('0002:00000449', $message->getId());
        $this->assertEquals('0002', $message->getNodeId());
        $time = new DateTime();
        $time->setTimestamp(1531911542);
        $this->assertEquals($time, $message->getTime());
        $this->assertEquals(85, $message->getLength());
        $this->assertEquals(
            '0A5D977BB5B6998E65CA04F180C9837E8CA418E5B8DD1BB29EBFD9BB6B86812F',
            $message->getHash()
        );
    }

    /**
     * @return array<string, array<int|string, array<int|string, string>|string>|string>
     */
    private function getRawData(): array
    {
        return json_decode(
            '{
            "current_block_time": "1531912192",
            "previous_block_time": "1531912160",
            "tx": {
                "data": "1A01000000000000204F5B00000000020049040000",
                "signature": "31DE145B54D5E1465143CAD0448F94EF4AAEFD3B117A41FDC905F085F953BDC4'
            . '0EB396A89D4FFF4FC08588C71DA3219F399BD1E286C335218371CC90C25AAA0E",
                "time": "1531912192"
            },
            "block_id": "5B4F1D60",
            "message_id": "0002:00000449",
            "node": "2",
            "node_msid": "1097",
            "time": "1531911542",
            "length": "85",
            "hash": "0A5D977BB5B6998E65CA04F180C9837E8CA418E5B8DD1BB29EBFD9BB6B86812F",
            "transactions": [
                {
                    "id": "0002:00000449:0001",
                    "type": "connection",
                    "port": "8002",
                    "ip_address": "10.69.3.43",
                    "size": "7"
                }
            ]
        }',
            true
        );
    }
}
