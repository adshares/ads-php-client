<?php

namespace Adshares\Ads\Tests\E2E\Entity;


use Adshares\Ads\AdsClient;
use Adshares\Ads\Driver\CliDriver;


class BroadcastTest extends \PHPUnit\Framework\TestCase
{
    public function testBroadcast()
    {
        $address = "0001-00000000-9B6F";
        $secret = "BB3425F914CA9F661CA6F3B908E07092B5AFB7F2FDAE2E94EDE12C83207CA743";
        $host = "10.69.3.43";
        $port = "9001";

        $message = "12";
        $driver = new CliDriver($address, $secret, $host, $port);
        $client = new AdsClient($driver);
        $response = $client->broadcast($message);

        $txId = $account = $response->getTx()->getId();

        $this->assertInternalType("string", $txId);
        print_r($txId);
    }

}

