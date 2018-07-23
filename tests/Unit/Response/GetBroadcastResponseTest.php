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
        $time->setTimestamp(1532351072);
        $this->assertEquals($time, $response->getCurrentBlockTime());
        $time->setTimestamp(1532351040);
        $this->assertEquals($time, $response->getPreviousBlockTime());
        $this->assertEquals('5B55D240', $response->getBlockId());
        $this->assertContains($response->getLogFile(), ['archive', 'new']);

        $this->assertInstanceOf(Tx::class, $response->getTx());
        $broadcasts = $response->getBroadcast();
        $this->assertCount(1, $broadcasts);
        foreach ($broadcasts as $broadcast) {
            $this->assertInstanceOf(Broadcast::class, $broadcast);
        }
    }

    private function getRawData(): array
    {
        return json_decode('{
            "current_block_time": "1532351072",
            "previous_block_time": "1532351040",
            "tx": {
                "data": "1201000100000040D2555B68D2555B",
                "signature": "2BB90103DF1E8E39CB38FA3A8E0733519010DE0B068278BEC039BA079FF8DEFFACCD7D436'
            . '886D220A80FD6A3AF1BEE20FA23E4287EE720F6A4A611BF42CDCB08",
                "time": "1532351080"
            },
            "block_time_hex": "5B55D240",
            "block_time": "1532351040",
            "broadcast_count": "1",
            "log_file": "archive",
            "broadcast": [{
                    "block_time": "1532351040",
                    "block_date": "2018-07-23 15:04:00",
                    "node": "1",
                    "account": "0",
                    "address": "0001-00000000-9B6F",
                    "account_msid": "26",
                    "time": "1532351047",
                    "date": "2018-07-23 15:04:07",
                    "data": "030100000000001A00000047D2555B0100",
                    "message": "7E",
                    "signature": "A12F210C3AC26CCCEAF19301C4985C9C1C86A45470729530C46FDC5999252492C17996F82735'
            . '9A10C35D456403D7B389D766324976A5145667B82E6193952D04",
                    "input_hash": "A79B8AC0561B9B7E2B9CB792714377D8DF864B30C87697FD967BA4505445C0A7",
                    "public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
                    "verify": "passed",
                    "node_msid": "58",
                    "node_mpos": "1",
                    "id": "0001:0000003A:0001",
                    "fee": "0.00000010000"
                }
            ]
        }', true);
    }
}
