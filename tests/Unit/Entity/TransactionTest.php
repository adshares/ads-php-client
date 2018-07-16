<?php

namespace Adshares\Ads\Tests\Unit\Entity;

use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Entity\Transaction\BroadcastTransaction;
use Adshares\Ads\Entity\Transaction\ConnectionTransaction;
use Adshares\Ads\Entity\Transaction\EmptyTransaction;

class TransactionTest extends \PHPUnit\Framework\TestCase
{
    public function testEmptyFromRaw(): void
    {
        /* @var EmptyTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawEmpty());

        $this->assertEquals('0002:00000026:0001', $transaction->getId());
        $this->assertEquals('empty', $transaction->getType());
        $this->assertEquals(10, $transaction->getSize());
    }

    public function testConnectionFromRaw(): void
    {
        /* @var ConnectionTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawConnection());

        $this->assertEquals('0002:00000026:0002', $transaction->getId());
        $this->assertEquals('connection', $transaction->getType());
        $this->assertEquals(8002, $transaction->getPort());
        $this->assertEquals('172.16.222.101', $transaction->getIpAddress());
        $this->assertEquals(7, $transaction->getSize());
    }

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
            . '6298009BD659420F7C39C6C3A42EAF067C0DC8BCD7AA8127AB179F3A0CE3240C', $transaction->getSignature());
        $this->assertEquals(82, $transaction->getSize());
    }

    private function getRawEmpty(): array
    {
        return json_decode('{
			"id": "0002:00000026:0001",
			"type": "empty",
			"size": "10"
		}', true);
    }

    private function getRawConnection(): array
    {
        return json_decode('{
			"id": "0002:00000026:0002",
			"type": "connection",
			"port": "8002",
			"ip_address": "172.16.222.101",
			"size": "7"
		}', true);
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
