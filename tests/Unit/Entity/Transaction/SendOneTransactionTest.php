<?php

namespace Adshares\Ads\Tests\Unit\Entity\Transaction;

use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Entity\Transaction\SendOneTransaction;

class SendOneTransactionTest extends \PHPUnit\Framework\TestCase
{
    public function testSendOneFromRaw(): void
    {
        /* @var SendOneTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawSendOne());

        $this->assertEquals('0001:00000002:0002', $transaction->getId());
        $this->assertEquals('send_one', $transaction->getType());
        $this->assertEquals(1, $transaction->getNode());
        $this->assertEquals(0, $transaction->getUser());
        $this->assertEquals(3, $transaction->getMsgId());
        $date = new \DateTime();
        $date->setTimestamp(1531501093);
        $this->assertEquals($date, $transaction->getTime());
        $this->assertEquals(1, $transaction->getTargetNode());
        $this->assertEquals(1, $transaction->getTargetUser());
        $this->assertEquals(10000, $transaction->getSenderFee());
        $this->assertEquals('0001-00000000-9B6F', $transaction->getSenderAddress());
        $this->assertEquals('0001-00000001-8B4E', $transaction->getTargetAddress());
        $this->assertEquals(1000000, $transaction->getAmount());
        $this->assertEquals(
            '0AC8A8E8DD7B4E4D70DBB090397F0C361345D5788B121179A0A15930BEEAC793',
            $transaction->getMessage()
        );
        $this->assertEquals(
            '2DB84AA9CD7D28C846B72C08DEBA9DAE0F9E25C6EAFD4A747B9B8962A271E552' .
            'D3025A8C6FC66EB47B7C3434A9C58DFB29E7D9EB793F375EA0D074140CB71C00',
            $transaction->getSignature()
        );
        $this->assertEquals(125, $transaction->getSize());
    }

    private function getRawSendOne(): array
    {
        return json_decode('{
			"id": "0001:00000002:0002",
			"type": "send_one",
			"node": "1",
			"user": "0",
			"msg_id": "3",
			"time": "1531501093",
			"target_node": "1",
			"target_user": "1",
			"sender_fee": "0.00000010000",
			"sender_address": "0001-00000000-9B6F",
			"target_address": "0001-00000001-8B4E",
			"amount": "0.00001000000",
			"message": "0AC8A8E8DD7B4E4D70DBB090397F0C361345D5788B121179A0A15930BEEAC793",
			"signature": "2DB84AA9CD7D28C846B72C08DEBA9DAE0F9E25C6EAFD4A747B9B8962A271E552' .
            'D3025A8C6FC66EB47B7C3434A9C58DFB29E7D9EB793F375EA0D074140CB71C00",
			"size": "125"
		}', true);
    }
}
