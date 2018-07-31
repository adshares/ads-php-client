<?php
/**
 * Copyright (C) 2018 Adshares sp. z. o.o.
 *
 * This file is part of PHP ADS Client
 *
 * PHP ADS Client is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * PHP ADS Client is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with PHP ADS Client.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace Adshares\Ads\Tests\Unit\Entity\Transaction;

use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Entity\Transaction\SendManyTransaction;

class SendManyTransactionWireTest extends \PHPUnit\Framework\TestCase
{
    public function testSendManyWiresFromRaw(): void
    {
        /* @var SendManyTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawSendMany());

        $wires = $transaction->getWires();
        /* @var \Adshares\Ads\Entity\Transaction\SendManyTransactionWire $wire */
        $wire = $wires[0];
        $this->assertEquals(1, $wire->getTargetNode());
        $this->assertEquals(1, $wire->getTargetUser());
        $this->assertEquals('0001-00000001-8B4E', $wire->getTargetAddress());
        $this->assertEquals(1, $wire->getAmount());

        $wire = $wires[1];
        $this->assertEquals(1, $wire->getTargetNode());
        $this->assertEquals(0, $wire->getTargetUser());
        $this->assertEquals('0001-00000000-9B6F', $wire->getTargetAddress());
        $this->assertEquals(100000000000, $wire->getAmount());
    }

    private function getRawSendMany(): array
    {
        return json_decode('{
            "id": "0001:0000001F:0001",
            "type": "send_many",
            "node": "1",
            "user": "0",
            "sender_address": "0001-00000000-9B6F",
            "msg_id": "5",
            "time": "1532005558",
            "wire_count": "2",
            "sender_fee": "0.00050000000",
            "wires": [
                {
                    "target_node": "1",
                    "target_user": "1",
                    "target_address": "0001-00000001-8B4E",
                    "amount": "0.00000000001"
                },
                {
                    "target_node": "1",
                    "target_user": "0",
                    "target_address": "0001-00000000-9B6F",
                    "amount": "1.00000000000"
                }
            ],
            "signature": "F30906B2258C664987031F2D1DDA558EB47EB55A8F1C6E3E12A3A389271ADB4B'
            . '1A7B4C2D75FE9790B2CF665ED8D55EBB13F51C8F172FE42CDED5BEC2356AB90E",
            "size": "109"
        }', true);
    }
}
