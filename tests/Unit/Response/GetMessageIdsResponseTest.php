<?php


namespace Adshares\Ads\Tests\Unit\Response;

use Adshares\Ads\Response\GetMessageIdsResponse;

class GetMessageIdsResponseTest extends \PHPUnit\Framework\TestCase
{
    public function testGetMessageIds()
    {
        $response = new GetMessageIdsResponse($this->getRawData());
        $time = new \DateTime();
        $time->setTimestamp(1532077312);
        $this->assertEquals($time, $response->getCurrentBlockTime());
        $time->setTimestamp(1532077280);
        $this->assertEquals($time, $response->getPreviousBlockTime());
        $this->assertEquals(7, $response->getMessageCount());
        $this->assertCount(7, $response->getMessageIds());
        $this->assertEquals('5B51A3E0', $response->getBlockId());
    }

    public function testGetMessageIdsEmpty()
    {
        $response = new GetMessageIdsResponse($this->getRawDataEmpty());
        $time = new \DateTime();
        $time->setTimestamp(1532077216);
        $this->assertEquals($time, $response->getCurrentBlockTime());
        $time->setTimestamp(1532077184);
        $this->assertEquals($time, $response->getPreviousBlockTime());
        $this->assertEquals(0, $response->getMessageCount());
        $this->assertCount(0, $response->getMessageIds());
        $this->assertEquals('5B51A3C0', $response->getBlockId());
    }

    private function getRawData(): array
    {
        return json_decode('{
            "current_block_time": "1532077312",
            "previous_block_time": "1532077280",
            "tx": {
                "data": "190200000000000EA5515BE0A3515B",
                "signature": "C33CB56C758FEBAD18D50592350BD720F9143E9CAB06BD981757D'
            . 'CE8D36DE18DB47F9CC7FAEC406C13BDB58EBAA323878C36D69825528C1F33C1A31E1572530F",
                "time": "1532077326"
            },
            "block_time_hex": "5B51A3E0",
            "block_time": "1532077024",
            "msghash": "CC2969C3524B5B94D7835E85FB972AFCF6091256DAC64527D5DB5A67673C3868",
            "message_count": "7",
            "confirmed": "yes",
            "messages": ["0001:00000001", "0001:00000002", "0001:00000003", "0002:00000001", '
            . '"0002:00000002", "0002:00000003", "0003:00000001"]
        }', true);
    }

    private function getRawDataEmpty(): array
    {
        return json_decode('{
            "current_block_time": "1532077216",
            "previous_block_time": "1532077184",
            "tx": {
                "data": "19010002000000BCA4515BC0A3515B",
                "signature": "1ABBC13782EEEB9BBBC48F51DB1163361241C66ACAE4AEDE53DD1208FAFAF89E7'
            . '6DEBFA3567287BF684EFDC3468057BF69A6F9F2DD77EBE9A518518CDD185A00",
                "time": "1532077244"
            },
            "block_time_hex": "5B51A3C0",
            "block_time": "1532076992",
            "msghash": "0000000000000000000000000000000000000000000000000000000000000000",
            "message_count": "0",
            "confirmed": "yes"
        }', true);
    }
}
