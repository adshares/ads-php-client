<?php


namespace Adshares\Ads\Tests\Unit\Response;

use Adshares\Ads\Entity\NetworkTx;
use Adshares\Ads\Entity\Transaction\AbstractTransaction;
use Adshares\Ads\Entity\Tx;
use Adshares\Ads\Response\GetTransactionResponse;

class GetTransactionResponseTest extends \PHPUnit\Framework\TestCase
{
    public function testGetTransactionFromRaw()
    {
        $response = new GetTransactionResponse($this->getRawData());
        $time = new \DateTime();
        $time->setTimestamp(1532347520);
        $this->assertEquals($time, $response->getCurrentBlockTime());
        $time->setTimestamp(1532347488);
        $this->assertEquals($time, $response->getPreviousBlockTime());

        $this->assertInstanceOf(Tx::class, $response->getTx());
        $this->assertInstanceOf(NetworkTx::class, $response->getNetworkTx());
        $transaction = $response->getTxn();
        $this->assertInstanceOf(AbstractTransaction::class, $transaction);

        $this->assertEquals('send_one', $transaction->getType());
        $this->assertEquals('5B55C460', $transaction->getBlockId());
        $this->assertEquals('0001:00000003:0001', $transaction->getId());
        $this->assertEquals(125, $transaction->getSize());
        $this->assertEquals('0001', $transaction->getNodeId());
        $this->assertEquals('0001:00000003', $transaction->getMessageId());
    }

    private function getRawData(): array
    {
        return json_decode('{
	"current_block_time": "1532347520",
	"previous_block_time": "1532347488",
	"tx": {
		"data": "140100000000009FC4555B0100030000000100",
		"signature": "4D4C4745E1D797FC5D0A3EBD870E3F9144C37F6CE3D6161928AA86D648478F0727761EDBD1EB4308E'
            . 'A293E640FA98772480B98F211697E47715352AF6C713E02",
		"time": "1532347551",
		"account_msid": "0",
		"account_hashin": "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF",
		"account_hashout": "25D5E0068EFE8F7CBCD9C407F2C9A42A96C56B66B4104B99185A0CF69C531A0F",
		"deduct": "0.00000000000",
		"fee": "0.00000000000"
	},
	"network_tx": {
		"id": "0001:00000003:0001",
		"block_time": "1532347488",
		"block_id": "5B55C460",
		"node": "1",
		"node_msid": "3",
		"node_mpos": "1",
		"size": "125",
		"hashpath_size": "6",
		"data": "040100000000000100000077C4555B01000100000000A0724E1809000000000000000000000000000000000000000000'
            . '0000000000000000000000000041503FB1E7BD84A3A94685FAC3841A53374DE00A3260ED5A88D4877585EAFA982E828DDA9'
            . '9F57EA3B20DAF4723BCD6325F63042A1ED13724CB7279CF728D940A",
		"hashpath": ["36976DC64EDC80AC9A72EFDE80BDDD323A5FA08A8CB44D5BB7D5A6555AA0DBCB", '
            . '"D37BF29BFAB387537A0ABBCE955386BFE004887232AC7F29AD2D661EBAD78B5A", '
            . '"E9CA4D62A2367A6C3885D46B02A763DECEBC9160EEC2C4C894858290F5B246BD", '
            . '"3411C500E1217CA657E2BF79C2D3597A9B5D71075E4FA7312854847025885923", '
            . '"AE2453CC3156712280AE2B410A938263167AFE13CDA61FD373372309773F0718", '
            . '"B17412D4BB2909C03E6D168652AF93C5B5045B4FFE40C2F487171AA3EF198A0F"]
	},
	"txn": {
		"type": "send_one",
		"node": "1",
		"user": "0",
		"msg_id": "1",
		"time": "1532347511",
		"target_node": "1",
		"target_user": "1",
		"sender_fee": "0.05000000000",
		"sender_address": "0001-00000000-9B6F",
		"target_address": "0001-00000001-8B4E",
		"amount": "100.00000000000",
		"message": "0000000000000000000000000000000000000000000000000000000000000000",
		"signature": "41503FB1E7BD84A3A94685FAC3841A53374DE00A3260ED5A88D4877585EAFA982E828DDA99F57EA3B20DAF472'
            . '3BCD6325F63042A1ED13724CB7279CF728D940A"
	}
}', true);
    }
}
