<?php

namespace Adshares\Ads\Tests\Unit\Entity;

use Adshares\Ads\Entity\Account;
use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Entity\Transaction\BroadcastTransaction;
use Adshares\Ads\Entity\Transaction\ConnectionTransaction;
use Adshares\Ads\Entity\Transaction\EmptyTransaction;
use Adshares\Ads\Entity\Transaction\KeyTransaction;
use Adshares\Ads\Entity\Transaction\LogAccountTransaction;
use Adshares\Ads\Entity\Transaction\NetworkTransaction;
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
        $this->assertEquals(10000000000000, $wire->getAmount());

        $wire = $wires[1];
        $this->assertEquals(1, $wire->getTargetNode());
        $this->assertEquals(2, $wire->getTargetUser());
        $this->assertEquals('0001-00000002-BB2D', $wire->getTargetAddress());
        $this->assertEquals(10000000000000, $wire->getAmount());
    }

    public function testAccountCreatedFromRaw(): void
    {
        /* @var KeyTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawAccountCreated());

        $this->assertEquals('0002:0000000A:0001', $transaction->getId());
        $this->assertEquals('account_created', $transaction->getType());
        $this->assertEquals(2, $transaction->getNode());
        $this->assertEquals(2, $transaction->getUser());
        $this->assertEquals(0, $transaction->getMsgId());
        $date = new \DateTime();
        $date->setTimestamp(1531493862);
        $this->assertEquals($date, $transaction->getTime());
        $this->assertEquals(1, $transaction->getTargetNode());
        $this->assertEquals(0, $transaction->getTargetUser());
        $this->assertEquals(
            'A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363',
            $transaction->getPublicKey()
        );
        $this->assertEquals(53, $transaction->getSize());
    }

    public function testChangeAccountKeyFromRaw(): void
    {
        /* @var KeyTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawChangeAccountKey());

        $this->assertEquals('0001:00000009:0001', $transaction->getId());
        $this->assertEquals('change_account_key', $transaction->getType());
        $this->assertEquals(1, $transaction->getNode());
        $this->assertEquals(0, $transaction->getUser());
        $this->assertEquals(5, $transaction->getMsgId());
        $date = new \DateTime();
        $date->setTimestamp(1531498103);
        $this->assertEquals($date, $transaction->getTime());
        $this->assertEquals(
            'EAE1C8793B5597C4B3F490E76AC31172C439690F8EE14142BB851A61F9A49F0E',
            $transaction->getPublicKey()
        );
        $this->assertEquals(
            '01411FAC10DE65000000008100000000000000B04EEF0100000000B04EEF0100'
            . '000000200000000000000020000000000000000000000000000000626C6F636B',
            $transaction->getPublicKeySignature()
        );
        $this->assertEquals('65870B267C50ABE43A63FE7294768C400DB050D455BCEC3E44C64B07F0F18392'
            . '348E7614A088DCC21327BC0A0F009A6A12CCFC070297E8E035C2DA9DA9449303', $transaction->getSignature());
        $this->assertEquals(111, $transaction->getSize());
    }

    public function testChangeNodeKeyFromRaw(): void
    {
        /* @var KeyTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawChangeNodeKey());

        $this->assertEquals('0001:00000003:0001', $transaction->getId());
        $this->assertEquals('change_node_key', $transaction->getType());
        $this->assertEquals(1, $transaction->getNode());
        $this->assertEquals(0, $transaction->getUser());
        $this->assertEquals(1, $transaction->getMsgId());
        $date = new \DateTime();
        $date->setTimestamp(1531495004);
        $this->assertEquals($date, $transaction->getTime());
        $this->assertEquals(0, $transaction->getTargetNode());
        $this->assertEquals(
            '73A5C92FA5142599B1C9863B43E026AFEFA6B57AEE8D189241C7F50C90BA5122',
            $transaction->getOldPublicKey()
        );
        $this->assertEquals(
            'EAE1C8793B5597C4B3F490E76AC31172C439690F8EE14142BB851A61F9A49F0E',
            $transaction->getNewPublicKey()
        );
        $this->assertEquals('005451A44896768C5F39713DA0622EF721682E14497E3E0220672D6C489B02FF'
            . 'B177FB13DF74BD870107EBFBAE9F6BA155AD4B57F4372463F97120EE35CD2007', $transaction->getSignature());
        $this->assertEquals(145, $transaction->getSize());
    }

    public function testCreateAccountFromRaw(): void
    {
        /* @var NetworkTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawCreateAccount());

        $this->assertEquals('0001:0000000E:0001', $transaction->getId());
        $this->assertEquals('create_account', $transaction->getType());
        $this->assertEquals(1, $transaction->getNode());
        $this->assertEquals(0, $transaction->getUser());
        $this->assertEquals(976, $transaction->getMsgId());
        $date = new \DateTime();
        $date->setTimestamp(1531495703);
        $this->assertEquals($date, $transaction->getTime());
        $this->assertEquals(1, $transaction->getTargetNode());
        $this->assertEquals('EBAEE201D66CD2E0B68DEE9A869FFBD14986E17770A3DA62779B6F06D0030000'
            . 'A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363', $transaction->getSignature());
        $this->assertEquals(117, $transaction->getSize());
    }

    public function testCreateNodeFromRaw(): void
    {
        /* @var NetworkTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawCreateNode());

        $this->assertEquals('0001:00000009:0001', $transaction->getId());
        $this->assertEquals('create_node', $transaction->getType());
        $this->assertEquals(1, $transaction->getNode());
        $this->assertEquals(0, $transaction->getUser());
        $this->assertEquals(1, $transaction->getMsgId());
        $date = new \DateTime();
        $date->setTimestamp(1531496775);
        $this->assertEquals($date, $transaction->getTime());
        $this->assertEquals('72F344B3F1E8C225C708CB1B6ACE62F9F776081F4C4F21BA25944350847EDA14'
            . '56C29F874BA3C9FCC367EDD13C148175946AA1D2D46EF1BBDD49FFE0507E640D', $transaction->getSignature());
        $this->assertEquals(79, $transaction->getSize());
    }

    public function testRetrieveFundsFromRaw(): void
    {
        /* @var NetworkTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawRetrieveFunds());

        $this->assertEquals('0001:0000000F:0001', $transaction->getId());
        $this->assertEquals('retrieve_funds', $transaction->getType());
        $this->assertEquals(1, $transaction->getNode());
        $this->assertEquals(0, $transaction->getUser());
        $this->assertEquals(1003, $transaction->getMsgId());
        $date = new \DateTime();
        $date->setTimestamp(1531495739);
        $this->assertEquals($date, $transaction->getTime());
        $this->assertEquals(2, $transaction->getTargetNode());
        $this->assertEquals(1, $transaction->getTargetUser());

        $this->assertEquals('CC05D9CE1816197AB8A02335CBB7ED0056DA088A4CFA593022679360B750E525'
            . '2EA1B1A0531398A3902FEF7B802F98AA6B1C417FB469F092A88508EBCAC5660A', $transaction->getSignature());
        $this->assertEquals(85, $transaction->getSize());
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

    private function getRawAccountCreated(): array
    {
        return json_decode('{
			"id": "0002:0000000A:0001",
			"type": "account_created",
			"node": "2",
			"user": "2",
			"msg_id": "0",
			"time": "1531493862",
			"target_node": "1",
			"target_user": "0",
			"public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
			"size": "53"
		}', true);
    }

    private function getRawChangeAccountKey(): array
    {
        return json_decode('{
			"id": "0001:00000009:0001",
			"type": "change_account_key",
			"node": "1",
			"user": "0",
			"msg_id": "5",
			"time": "1531498103",
			"public_key": "EAE1C8793B5597C4B3F490E76AC31172C439690F8EE14142BB851A61F9A49F0E",
			"public_key_signature": "01411FAC10DE65000000008100000000000000B04EEF0100000000B04EEF0100'
            . '000000200000000000000020000000000000000000000000000000626C6F636B",
			"signature": "65870B267C50ABE43A63FE7294768C400DB050D455BCEC3E44C64B07F0F18392'
            . '348E7614A088DCC21327BC0A0F009A6A12CCFC070297E8E035C2DA9DA9449303",
			"size": "111"
		}', true);
    }

    private function getRawChangeNodeKey(): array
    {
        return json_decode('{
			"id": "0001:00000003:0001",
			"type": "change_node_key",
			"node": "1",
			"user": "0",
			"msg_id": "1",
			"time": "1531495004",
			"target_node": "0",
			"old_public_key": "73A5C92FA5142599B1C9863B43E026AFEFA6B57AEE8D189241C7F50C90BA5122",
			"new_public_key": "EAE1C8793B5597C4B3F490E76AC31172C439690F8EE14142BB851A61F9A49F0E",
			"signature": "005451A44896768C5F39713DA0622EF721682E14497E3E0220672D6C489B02FF'
            . 'B177FB13DF74BD870107EBFBAE9F6BA155AD4B57F4372463F97120EE35CD2007",
			"size": "145"
		}', true);
    }

    private function getRawCreateAccount(): array
    {
        return json_decode('{
			"id": "0001:0000000E:0001",
			"type": "create_account",
			"node": "1",
			"user": "0",
			"msg_id": "976",
			"time": "1531495703",
			"target_node": "1",
			"signature": "EBAEE201D66CD2E0B68DEE9A869FFBD14986E17770A3DA62779B6F06D0030000'
            . 'A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
			"size": "117"
		}', true);
    }

    private function getRawCreateNode(): array
    {
        return json_decode('{
			"id": "0001:00000009:0001",
			"type": "create_node",
			"node": "1",
			"user": "0",
			"msg_id": "1",
			"time": "1531496775",
			"signature": "72F344B3F1E8C225C708CB1B6ACE62F9F776081F4C4F21BA25944350847EDA14'
            . '56C29F874BA3C9FCC367EDD13C148175946AA1D2D46EF1BBDD49FFE0507E640D",
			"size": "79"
		}', true);
    }

    private function getRawRetrieveFunds(): array
    {
        return json_decode('{
			"id": "0001:0000000F:0001",
			"type": "retrieve_funds",
			"node": "1",
			"user": "0",
			"msg_id": "1003",
			"time": "1531495739",
			"target_node": "2",
			"target_user": "1",
			"signature": "CC05D9CE1816197AB8A02335CBB7ED0056DA088A4CFA593022679360B750E525'
            . '2EA1B1A0531398A3902FEF7B802F98AA6B1C417FB469F092A88508EBCAC5660A",
			"size": "85"
		}', true);
    }
}
