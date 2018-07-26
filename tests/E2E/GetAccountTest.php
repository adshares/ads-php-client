<?php

namespace Adshares\Ads\Tests\E2E;

use Adshares\Ads\AdsClient;
use Adshares\Ads\Driver\CliDriver;

class GetAccountTest extends \PHPUnit\Framework\TestCase
{
    private $address = '0001-00000000-9B6F';
    private $secret = 'BB3425F914CA9F661CA6F3B908E07092B5AFB7F2FDAE2E94EDE12C83207CA743';
    private $host = '10.69.3.43';
    private $port = 9001;

    public function testGetAccount()
    {
        $accountAddress = '0001-00000000-9B6F';
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);
        $response = $client->getAccount($accountAddress);

        $str = $response->getAccount()->getAddress();
        $this->assertEquals($accountAddress, $str);

        $str = $response->getNetworkAccount()->getAddress();
        $this->assertEquals($accountAddress, $str);
    }
}
