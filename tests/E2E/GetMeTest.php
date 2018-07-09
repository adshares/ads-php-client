<?php

namespace Adshares\Ads\Tests\E2E\Entity;


use Adshares\Ads\AdsClient;
use Adshares\Ads\Driver\CliDriver;


class GetMeTest extends \PHPUnit\Framework\TestCase
{
    public function testGetMe()
    {
        $address = "0001-00000000-9B6F";
        $secret = "BB3425F914CA9F661CA6F3B908E07092B5AFB7F2FDAE2E94EDE12C83207CA743";
        $host = "10.69.3.43";
        $port = "9001";

        $driver = new CliDriver($address, $secret, $host, $port);
        $client = new AdsClient($driver);
        $response = $client->getMe();

        $account = $response->getAccount();
        $this->assertEquals($address, $account->getAddress());

    }

}

