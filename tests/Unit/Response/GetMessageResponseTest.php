<?php


namespace Adshares\Ads\Tests\Unit\Response;

use Adshares\Ads\Response\GetMessageResponse;

class GetMessageResponseTest extends \PHPUnit\Framework\TestCase
{
    public function testGetMessageIdsFromRaw()
    {
        $response = new GetMessageResponse($this->getRawData());
        $time = new \DateTime();
        $time->setTimestamp(1532012352);
        $this->assertEquals($time, $response->getCurrentBlockTime());
        $time->setTimestamp(1532012320);
        $this->assertEquals($time, $response->getPreviousBlockTime());

        $this->assertInstanceOf('Adshares\Ads\Entity\Tx', $response->getTx());
        $this->assertInstanceOf('Adshares\Ads\Entity\Message', $response->getMessage());
        $transactions = $response->getTransactions();
        $this->assertCount(2, $transactions);
        foreach ($transactions as $transaction) {
            $this->assertInstanceOf('Adshares\Ads\Entity\transaction\AbstractTransaction', $transaction);
        }
    }

    private function getRawData(): array
    {
        return json_decode('{
            "current_block_time": "1532012352",
            "previous_block_time": "1532012320",
            "tx": {
                "data": "1A02000100000046A7505B0000000003003B000000",
                "signature": "B476109568467C1EC1D9F2DCE3A0CAE2758D30504233274CAD64FB5581FB738214'
            . '2ADBAF0565A820D3144DC588924AA8D87B45C40E3D78920A87EF3679C5A002",
                "time": "1532012358"
            },
            "block_id": "5B50A6A0",
            "message_id": "0003:0000003B",
            "node": "3",
            "node_msid": "59",
            "time": "1532012203",
            "length": "308",
            "hash": "CA4F8EBC994E7A15B163A8DA3BED30D193D3867BFF758F3CACBB4DB4EC9D1B0C",
            "transactions": [{
                    "id": "0003:0000003B:0001",
                    "type": "log_account",
                    "node": "3",
                    "user": "0",
                    "msg_id": "1",
                    "time": "1532012198",
                    "signature": "0D15530D8F728F88311C93D244E6FF2CFA445F38C406013598753BDC0CE48C51A5423'
            . '0B2C86A7BAF95F891D8E7C2E7A31C014A136DBE7BD05984517E9A9D7A05",
                    "network_account": {
                        "address": "0003-00000000-DFEC",
                        "node": "3",
                        "id": "0",
                        "msid": "1",
                        "time": "1532008192",
                        "date": "2018-07-19 15:49:52",
                        "status": "0",
                        "paired_node": "3",
                        "paired_id": "0",
                        "local_change": "1532008192",
                        "remote_change": "1532012160",
                        "balance": "7999999.99503635570",
                        "public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
                        "hash": "FBC03828DDC71C22772CED81DFCEEBC62F74E8A4B185B47746424BF38C966DA8",
                        "checksum": "true"
                    },
                    "size": "207"
                }, {
                    "id": "0003:0000003B:0002",
                    "type": "connection",
                    "port": "8003",
                    "ip_address": "172.16.222.101",
                    "version": "@",
                    "size": "23"
                }
            ]
        }
        ', true);
    }
}
