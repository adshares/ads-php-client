<?php

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
        return json_decode('{
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
		}', true);
    }
}
