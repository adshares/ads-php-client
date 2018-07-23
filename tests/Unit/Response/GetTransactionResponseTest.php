<?php


namespace Adshares\Ads\Tests\Unit\Response;

use Adshares\Ads\Response\GetTransactionResponse;

class GetTransactionResponseTest extends \PHPUnit\Framework\TestCase
{
    public function testGetTransactionFromRaw()
    {
        $response = new GetTransactionResponse($this->getRawData());
        $time = new \DateTime();
        $time->setTimestamp(1531495808);
        $this->assertEquals($time, $response->getCurrentBlockTime());
        $time->setTimestamp(1531495776);
        $this->assertEquals($time, $response->getPreviousBlockTime());

        $this->assertInstanceOf('Adshares\Ads\Entity\Tx', $response->getTx());
        $this->assertInstanceOf('Adshares\Ads\Entity\NetworkTx', $response->getNetworkTx());
        $transaction = $response->getTxn();
        $this->assertInstanceOf('Adshares\Ads\Entity\Transaction\AbstractTransaction', $transaction);

        $this->assertEquals('retrieve_funds', $transaction->getType());
        $this->assertEquals('AABBCCDD', $transaction->getBlockId());
        $this->assertEquals('0001:0000000B:0001', $transaction->getId());
        $this->assertEquals(85, $transaction->getSize());
        $this->assertEquals('0001', $transaction->getNodeId());
        $this->assertEquals('0001:0000000B', $transaction->getMessageId());
    }

    private function getRawData(): array
    {
        return json_decode('{
            "current_block_time": "1531495808",
            "previous_block_time": "1531495776",
            "tx": {
                "data": "1401000000000084C5485B01000B0000000100",
                "signature": "F90A3F7442F3D16EFF02C03A648E80B3FC17350062025B5E3C304B0939184B'
            . '37DBE6006B57E1E75C04B4E626C5FC2D3BCE51F38413FB35F3FEE62BFA769EA101",
                "time": "1531495812",
                "account_msid": "0",
                "account_hashin": "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF",
                "account_hashout": "4BA8CA1FEB710C345CE69830CC7A6DEDAF6C8EE0A3F9784CC380E05CC54780A0",
                "deduct": "0.00000000000",
                "fee": "0.00000000000"
            },
            "network_tx": {
                "id": "0001:0000000B:0001",
                "block_time": "1531495616",
                "block_id": "AABBCCDD",
                "node": "1",
                "node_msid": "11",
                "node_mpos": "1",
                "size": "85",
                "hashpath_size": "7",
                "data": "0801000000000002000000BBC4485B020001000000D5FE451B11A7C42A8E322F40315FA52482A0314A15C518'
            . '3753019946C404FFA088D6300E6D11B9F5B2E39C07D074CE763E3263331B0C80C6C2BF7373BA03EB0B",
                "hashpath": ["7FBCE77182E5FDD6E58A08D3951179C44EA16F73936DDDF86B598B32DEEDF438", '
            . '"E8A17D524DF8671BD57FB04A7BC0DF8B260C56BB7E4AD0577E679ECC24B2BCE7", '
            . '"A4E0E06374166C7D131F91AD2B2F7577494A813A21D03710ACE7DEC8B9CE7A89", '
            . '"A588957308D6BD131950929540E962747052C1BD4E0BAADEA89594E5E171BDC8", '
            . '"1381D4255F4051F37B65CD80D596BA84FBAAF2197816041F5EB5FD8F03F1C0BD", '
            . '"A528B0C2763B85A8F33081E6E01721858C63872EB6B45C648B5339FFF3A350A8", '
            . '"7AD28E9374EFD27AFF422CCE5BE7FDB0812C3AAFB69268BEEA7517A11F6C44D2"]
            },
            "txn": {
                "type": "retrieve_funds",
                "node": "1",
                "user": "0",
                "msg_id": "2",
                "time": "1531495611",
                "target_node": "2",
                "target_user": "1",
                "signature": "D5FE451B11A7C42A8E322F40315FA52482A0314A15C5183753019946C404FFA0'
            . '88D6300E6D11B9F5B2E39C07D074CE763E3263331B0C80C6C2BF7373BA03EB0B"
            }
        }', true);
    }
}
