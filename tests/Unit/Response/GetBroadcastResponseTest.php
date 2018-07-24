<?php


namespace Adshares\Ads\Tests\Unit\Response;

use Adshares\Ads\Entity\Broadcast;
use Adshares\Ads\Entity\Tx;
use Adshares\Ads\Response\GetBroadcastResponse;
use Adshares\Ads\Tests\Unit\Raw;

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
        $this->assertEquals(1, $response->getBroadcastCount());
    }

    private function getRawData(): array
    {
        return json_decode(Raw::getBroadcast(), true);
    }
}
