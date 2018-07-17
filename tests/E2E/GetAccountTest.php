<?php

namespace Adshares\Ads\Tests\E2E;

use Adshares\Ads\AdsClient;
use Adshares\Ads\Driver\CliDriver;

class GetAccountTest extends \PHPUnit\Framework\TestCase
{
    public function testGetAccount()
    {
        $address = "0001-00000000-9B6F";
        $secret = "BB3425F914CA9F661CA6F3B908E07092B5AFB7F2FDAE2E94EDE12C83207CA743";
        $host = "10.69.3.43";
        $port = 9001;

        $accountAddress = "0001-00000000-9B6F";
        $driver = new CliDriver($address, $secret, $host, $port);
        $client = new AdsClient($driver);
        $response = $client->getAccount($accountAddress);

        $str = $response->getAccount()->getAddress();
        $this->assertEquals($accountAddress, $str);

        $str = $response->getNetworkAccount()->getAddress();
        $this->assertEquals($accountAddress, $str);
    }
}
