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

namespace Adshares\Ads\Tests\Unit\Entity\Transaction;

use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Entity\Transaction\BroadcastTransaction;

class BroadcastTransactionTest extends \PHPUnit\Framework\TestCase
{

    public function testBroadcastFromRaw(): void
    {
        /* @var BroadcastTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawBroadcast());

        $this->assertEquals('0001:00000007:0001', $transaction->getId());
        $this->assertEquals('broadcast', $transaction->getType());
        $this->assertEquals(1, $transaction->getNode());
        $this->assertEquals(0, $transaction->getUser());
        $this->assertEquals(2, $transaction->getMsgId());
        $this->assertEquals('0001-00000000-9B6F', $transaction->getSenderAddress());
        $date = new \DateTime();
        $date->setTimestamp(1531494107);
        $this->assertEquals($date, $transaction->getTime());
        $this->assertEquals(1, $transaction->getMessageLength());
        $this->assertEquals('A8', $transaction->getMessage());
        $this->assertEquals(
            'B6CBDF52096ABFF56E1A0DEC09A52DF0E3C513067F4BDA69D1F760664B612142'
            . '6298009BD659420F7C39C6C3A42EAF067C0DC8BCD7AA8127AB179F3A0CE3240C',
            $transaction->getSignature()
        );
        $this->assertEquals(82, $transaction->getSize());
    }

    private function getRawBroadcast(): array
    {
        return json_decode(
            '{
			"id": "0001:00000007:0001",
			"type": "broadcast",
			"node": "1",
			"user": "0",
			"msg_id": "2",
			"time": "1531494107",
			"message_length": "1",
			"message": "A8",
			"signature": "B6CBDF52096ABFF56E1A0DEC09A52DF0E3C513067F4BDA69D1F760664B612142'
            . '6298009BD659420F7C39C6C3A42EAF067C0DC8BCD7AA8127AB179F3A0CE3240C",
			"size": "82"
		}',
            true
        );
    }
}
