<?php


namespace Adshares\Ads\Tests\Unit\Response;

use Adshares\Ads\Entity\Broadcast;
use Adshares\Ads\Entity\Tx;
use Adshares\Ads\Response\GetBroadcastResponse;

class GetBroadcastResponseTest extends \PHPUnit\Framework\TestCase
{
    public function testGetBroadcastFromRaw()
    {
        /* @var GetBroadcastResponse $response */
        $response = new GetBroadcastResponse($this->getRawData());
        $time = new \DateTime();
        $time->setTimestamp(1532100384);
        $this->assertEquals($time, $response->getCurrentBlockTime());
        $time->setTimestamp(1532100352);
        $this->assertEquals($time, $response->getPreviousBlockTime());
        $this->assertEquals('5B51FEE0', $response->getBlockId());
        $this->assertContains($response->getLogFile(), ['archive', 'new']);

        $this->assertInstanceOf(Tx::class, $response->getTx());
        $broadcasts = $response->getBroadcast();
        foreach ($broadcasts as $broadcast) {
            $this->assertInstanceOf(Broadcast::class, $broadcast);
        }
    }

    private function getRawData(): array
    {
        return json_decode('{
            "current_block_time": "1532100384",
            "previous_block_time": "1532100352",
            "tx": {
                "data": "12010000000000E0FE515B23FF515B",
                "signature": "2EC66920B2128EC3522DE6B85E55865CF8AC4108A991D4743D9E163D024B966F'
            . 'A2487C210B596280EE6EC318320443C1A5D288E8D357E3A1F50DE8FCF5E8B701",
                "time": "1532100387"
            },
            "log_file": "new",
            "block_time_hex": "5B51FEE0",
            "block_time": "1532100320",
            "broadcast": [{
                    "block_time": "1532100320",
                    "block_date": "2018-07-20 17:25:20",
                    "node": "1",
                    "account": "0",
                    "address": "0001-00000000-9B6F",
                    "account_msid": "1",
                    "time": "1532100323",
                    "date": "2018-07-20 17:25:23",
                    "data": "0301000000000001000000E3FE515B0100",
                    "message": "FE",
                    "signature": "1FB7A83994767C48F19EBB00946A3E96883FC4E7BE5F2AED3A0111F04FA58'
            . 'CC34D14D3CD93AA4F5EFCCC86D3C14A222989263B40D5F3BB3A6DA858818497BE00",
                    "input_hash": "CD3CC372397CFE14F62BF0CD3300DD3C18360A10846E1CBF28E53E6D01C0FCBB",
                    "public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
                    "verify": "passed",
                    "node_msid": "3",
                    "node_mpos": "2",
                    "id": "0001:00000003:0002",
                    "fee": "0.00000010000"
                }
            ]
        }', true);
    }
}
