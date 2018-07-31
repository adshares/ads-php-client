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
use Adshares\Ads\Entity\Transaction\StatusTransaction;

class StatusTransactionTest extends \PHPUnit\Framework\TestCase
{
    public function testSetAccountStatusFromRaw(): void
    {
        /* @var StatusTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawSetAccountStatus());

        $this->assertEquals('0001:000000BA:0001', $transaction->getId());
        $this->assertEquals('set_account_status', $transaction->getType());
        $this->assertEquals(1, $transaction->getNode());
        $this->assertEquals(0, $transaction->getUser());
        $this->assertEquals(5, $transaction->getMsgId());
        $date = new \DateTime();
        $date->setTimestamp(1532092391);
        $this->assertEquals($date, $transaction->getTime());
        $this->assertEquals(1, $transaction->getTargetNode());
        $this->assertEquals(0, $transaction->getTargetUser());
        $this->assertEquals(16, $transaction->getStatus());
        $this->assertEquals(
            '026322252CE6AFF35452A2949F811BA7C9A24400D00F608CBFE2ED266AE'
            . 'B29991B6650D69200DFE73630BD4FA8A47308E6DC37CD1F0CA11152C23B88853D7304',
            $transaction->getSignature()
        );
        $this->assertEquals(87, $transaction->getSize());
    }

    public function testSetNodeStatusFromRaw(): void
    {
        /* @var StatusTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawSetNodeStatus());

        $this->assertEquals('0001:000000B8:0001', $transaction->getId());
        $this->assertEquals('set_node_status', $transaction->getType());
        $this->assertEquals(1, $transaction->getNode());
        $this->assertEquals(0, $transaction->getUser());
        $this->assertEquals(3, $transaction->getMsgId());
        $date = new \DateTime();
        $date->setTimestamp(1532092353);
        $this->assertEquals($date, $transaction->getTime());
        $this->assertEquals(1, $transaction->getTargetNode());
        $this->assertNull($transaction->getTargetUser());
        $this->assertEquals(8, $transaction->getStatus());
        $this->assertEquals(
            '49F7A2B37C91ED8735C2D93BDD490EB83B3DFBD4A1E9C4B6F207C72ADA7BE1BF'
            . '2C91E8EB61ACFAAAE5202EAC1FF43CA64A1A5CA5F3192A25DDCBD1C1D5DD290A',
            $transaction->getSignature()
        );
        $this->assertEquals(85, $transaction->getSize());
    }

    public function testUnsetAccountStatusFromRaw(): void
    {
        /* @var StatusTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawUnsetAccountStatus());

        $this->assertEquals('0001:000000BB:0001', $transaction->getId());
        $this->assertEquals('unset_account_status', $transaction->getType());
        $this->assertEquals(1, $transaction->getNode());
        $this->assertEquals(0, $transaction->getUser());
        $this->assertEquals(6, $transaction->getMsgId());
        $date = new \DateTime();
        $date->setTimestamp(1532092407);
        $this->assertEquals($date, $transaction->getTime());
        $this->assertEquals(1, $transaction->getTargetNode());
        $this->assertEquals(0, $transaction->getTargetUser());
        $this->assertEquals(16, $transaction->getStatus());
        $this->assertEquals(
            'DFDA2E96A0A662C142B4A3BE63ED84FCE9909BF7E3663458FA338DE94EA98AFA'
            . '61E6BAEC58964DE1DC4B3ACDA0B6BA15576FA87BFE066EB15B9C3CEE6C6B810E',
            $transaction->getSignature()
        );
        $this->assertEquals(87, $transaction->getSize());
    }

    public function testUnsetNodeStatusFromRaw(): void
    {
        /* @var StatusTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawUnsetNodeStatus());

        $this->assertEquals('0001:000000B9:0001', $transaction->getId());
        $this->assertEquals('unset_node_status', $transaction->getType());
        $this->assertEquals(1, $transaction->getNode());
        $this->assertEquals(0, $transaction->getUser());
        $this->assertEquals(4, $transaction->getMsgId());
        $date = new \DateTime();
        $date->setTimestamp(1532092371);
        $this->assertEquals($date, $transaction->getTime());
        $this->assertEquals(1, $transaction->getTargetNode());
        $this->assertNull($transaction->getTargetUser());
        $this->assertEquals(8, $transaction->getStatus());
        $this->assertEquals(
            '67FF0C4E6B937DEF1171656C0105ACFC0DEC53010009446EAEB3BA5F68FFE446'
            . 'A158892073B132717F263851C657EB888E3D0088DF119AED0FBC015831DFDA05',
            $transaction->getSignature()
        );
        $this->assertEquals(85, $transaction->getSize());
    }

    private function getRawSetAccountStatus(): array
    {
        return json_decode('{
			"id": "0001:000000BA:0001",
			"type": "set_account_status",
			"node": "1",
			"user": "0",
			"msg_id": "5",
			"time": "1532092391",
			"target_node": "1",
			"target_user": "0",
			"status": "16",
			"signature": "026322252CE6AFF35452A2949F811BA7C9A24400D00F608CBFE2ED266AE'
            . 'B29991B6650D69200DFE73630BD4FA8A47308E6DC37CD1F0CA11152C23B88853D7304",
			"size": "87"
		}', true);
    }

    private function getRawSetNodeStatus(): array
    {
        return json_decode('{
			"id": "0001:000000B8:0001",
			"type": "set_node_status",
			"node": "1",
			"user": "0",
			"msg_id": "3",
			"time": "1532092353",
			"target_node": "1",
			"status": "8",
			"signature": "49F7A2B37C91ED8735C2D93BDD490EB83B3DFBD4A1E9C4B6F207C72ADA7BE1BF'
            . '2C91E8EB61ACFAAAE5202EAC1FF43CA64A1A5CA5F3192A25DDCBD1C1D5DD290A",
			"size": "85"
		}', true);
    }

    private function getRawUnsetAccountStatus(): array
    {
        return json_decode('{
			"id": "0001:000000BB:0001",
			"type": "unset_account_status",
			"node": "1",
			"user": "0",
			"msg_id": "6",
			"time": "1532092407",
			"target_node": "1",
			"target_user": "0",
			"status": "16",
			"signature": "DFDA2E96A0A662C142B4A3BE63ED84FCE9909BF7E3663458FA338DE94EA98AFA'
            . '61E6BAEC58964DE1DC4B3ACDA0B6BA15576FA87BFE066EB15B9C3CEE6C6B810E",
			"size": "87"
		}', true);
    }

    private function getRawUnsetNodeStatus(): array
    {
        return json_decode('{
			"id": "0001:000000B9:0001",
			"type": "unset_node_status",
			"node": "1",
			"user": "0",
			"msg_id": "4",
			"time": "1532092371",
			"target_node": "1",
			"status": "8",
			"signature": "67FF0C4E6B937DEF1171656C0105ACFC0DEC53010009446EAEB3BA5F68FFE446'
            . 'A158892073B132717F263851C657EB888E3D0088DF119AED0FBC015831DFDA05",
			"size": "85"
		}', true);
    }
}
