<?php


namespace Adshares\Ads\Tests\Unit\Response;

use Adshares\Ads\Response\GetAccountResponse;
use Adshares\Ads\Tests\Unit\Raw;

class AbstractResponseTest extends \PHPUnit\Framework\TestCase
{
    public function testAbstractResponse()
    {
        $response = new GetAccountResponse(json_decode(Raw::getAccount(), true));

        $nonExistent = $response->getRawData('a');
        $this->assertNull($nonExistent);

        /* @var int $rawPreviousBlockTime */
        $rawPreviousBlockTime = $response->getRawData('previous_block_time');
        $time = new \DateTime();
        $time->setTimestamp($rawPreviousBlockTime);
        $this->assertEquals($time, $response->getPreviousBlockTime());
    }
}
