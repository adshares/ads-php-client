<?php

namespace Adshares\Ads\Tests\Unit\Entity;

use Adshares\Ads\Entity\Account;
use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Entity\Transaction\BroadcastTransaction;
use Adshares\Ads\Entity\Transaction\ConnectionTransaction;
use Adshares\Ads\Entity\Transaction\EmptyTransaction;
use Adshares\Ads\Entity\Transaction\LogAccountTransaction;
use Adshares\Ads\Entity\Transaction\SendManyTransaction;
use Adshares\Ads\Entity\Transaction\SendOneTransaction;

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
            . '6298009BD659420F7C39C6C3A42EAF067C0DC8BCD7AA8127AB179F3A0CE3240C',
            $transaction->getSignature()
        );
        $this->assertEquals(82, $transaction->getSize());
    }

    public function testLogAccountFromRaw(): void
    {
        /* @var LogAccountTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawLogAccount());

        $this->assertEquals('0002:00000012:0001', $transaction->getId());
        $this->assertEquals('log_account', $transaction->getType());
        $this->assertEquals(2, $transaction->getNode());
        $this->assertEquals(1, $transaction->getUser());
        $this->assertEquals(1, $transaction->getMsgId());
        $date = new \DateTime();
        $date->setTimestamp(1531496426);
        $this->assertEquals($date, $transaction->getTime());
        $this->assertEquals(
            '8FCF056D26B03DFF50624933FE8CAE43C8C7160CBBCA5B4FD9EDBDEF445F39F3'
            . '13B57CB9EB1908E732186D9F1433F69E07FD1EF49D44596A08D7A34F560EF109',
            $transaction->getSignature()
        );
        $this->assertEquals(207, $transaction->getSize());

        /* @var Account $networkAccount */
        $account = $transaction->getNetworkAccount();

        $this->assertEquals('0002-00000001-659C', $account->getAddress());
        $this->assertEquals(2, $account->getNode());
        $this->assertEquals(1, $account->getId());
        $this->assertEquals(1, $account->getMsid());
        $date = new \DateTime();
        $date->setTimestamp(1531496192);
        $this->assertEquals($date, $account->getTime());
        $this->assertEquals(0, $account->getStatus());
        $this->assertEquals(2, $account->getPairedNode());
        $this->assertEquals(1, $account->getPairedId());
        $date->setTimestamp(1531496192);
        $this->assertEquals($date, $account->getLocalChange());
        $date->setTimestamp(1531496384);
        $this->assertEquals($date, $account->getRemoteChange());
        $this->assertEquals(69999999980000000, $account->getBalance());
        $this->assertEquals(
            'A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363',
            $account->getPublicKey()
        );
        $this->assertEquals('68E046D32C6959447B1284A9F51CFACE9CE587446F698039D93FFB1FF1927080', $account->getHash());
    }

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
        $this->assertEquals('0AC8A8E8DD7B4E4D70DBB090397F0C361345D5788B121179A0A15930BEEAC793', $transaction->getMessage());
        $this->assertEquals(
            '2DB84AA9CD7D28C846B72C08DEBA9DAE0F9E25C6EAFD4A747B9B8962A271E552' .
            'D3025A8C6FC66EB47B7C3434A9C58DFB29E7D9EB793F375EA0D074140CB71C00',
            $transaction->getSignature()
        );
        $this->assertEquals(125, $transaction->getSize());
    }

    public function testSendManyFromRaw(): void
    {
        /* @var SendManyTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawSendMany());

        $this->assertEquals('0001:00000002:0001', $transaction->getId());
        $this->assertEquals('send_many', $transaction->getType());
        $this->assertEquals(1, $transaction->getNode());
        $this->assertEquals(0, $transaction->getUser());
        $this->assertEquals('0001-00000000-9B6F', $transaction->getSenderAddress());
        $this->assertEquals(2, $transaction->getMsgId());

        $date = new \DateTime();
        $date->setTimestamp(1531501092);
        $this->assertEquals($date, $transaction->getTime());
        $transactionCount = $transaction->getTransactionCount();
        $this->assertEquals(2, $transactionCount);
        $this->assertCount($transactionCount, $transaction->getWires());
        $this->assertEquals(10000000000, $transaction->getSenderFee());
        $this->assertEquals(
            'F19B545AD002B8C331BC879CE3F45EF54A58611643FE26F0A48D2F40B0C18DB4'
            . '17669DB39D1731D5369872F8A2F702C46484CD43483B8CD1862EA3E223FEDD0A',
            $transaction->getSignature()
        );
        $this->assertEquals(109, $transaction->getSize());
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

    private function getRawLogAccount(): array
    {
        return json_decode('{
			"id": "0002:00000012:0001",
			"type": "log_account",
			"node": "2",
			"user": "1",
			"msg_id": "1",
			"time": "1531496426",
			"signature": "8FCF056D26B03DFF50624933FE8CAE43C8C7160CBBCA5B4FD9EDBDEF445F39F3'
            . '13B57CB9EB1908E732186D9F1433F69E07FD1EF49D44596A08D7A34F560EF109",
			"network_account": {
				"address": "0002-00000001-659C",
				"node": "2",
				"id": "1",
				"msid": "1",
				"time": "1531496192",
				"date": "2018-07-13 17:36:32",
				"status": "0",
				"paired_node": "2",
				"paired_id": "1",
				"local_change": "1531496192",
				"remote_change": "1531496384",
				"balance": "699999.99980000000",
				"public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
				"hash": "68E046D32C6959447B1284A9F51CFACE9CE587446F698039D93FFB1FF1927080",
				"checksum": "true"
			},
			"size": "207"
		}', true);
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

    private function getRawSendMany(): array
    {
        return json_decode('{
			"id": "0001:00000002:0001",
			"type": "send_many",
			"node": "1",
			"user": "0",
			"sender_address": "0001-00000000-9B6F",
			"msg_id": "2",
			"time": "1531501092",
			"transaction_count": "2",
			"sender_fee": "0.10000000000",
			"wires": [{
					"target_node": "1",
					"target_user": "1",
					"target_address": "0001-00000001-8B4E",
					"amount": "100.00000000000"
				}, {
					"target_node": "1",
					"target_user": "2",
					"target_address": "0001-00000002-BB2D",
					"amount": "100.00000000000"
				}
			],
			"signature": "F19B545AD002B8C331BC879CE3F45EF54A58611643FE26F0A48D2F40B0C18DB4'
            . '17669DB39D1731D5369872F8A2F702C46484CD43483B8CD1862EA3E223FEDD0A",
			"size": "109"
		}', true);
    }
}
