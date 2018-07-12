<?php

namespace Adshares\Ads\Tests\E2E;

use Adshares\Ads\AdsClient;
use Adshares\Ads\Driver\CliDriver;

class SendTransferTest extends \PHPUnit\Framework\TestCase
{
    private $address = "0001-00000000-9B6F";
    private $secret = "BB3425F914CA9F661CA6F3B908E07092B5AFB7F2FDAE2E94EDE12C83207CA743";
    private $host = "10.69.3.43";
    private $port = 9001;

    public function testSendOne()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $amount = 1;
        $message = "0000111122223333444455556666777700001111222233334444555566667777";
        $response = $client->sendOne($this->address, $amount, $message);
        $account = $response->getAccount();
        $this->assertEquals($this->address, $account->getAddress());

        $tx = $response->getTx();
        $this->assertEquals($amount, $tx->getDeduct() - $tx->getFee());
        $this->assertInternalType("string", $tx->getId());
    }

    public function testSendMany()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $amount = 1;
        $wires = [
            "0001-00000000-XXXX" => $amount,
            "0001-00000001-XXXX" => $amount,
            "0002-00000000-XXXX" => $amount,
            "0002-00000001-XXXX" => $amount,
        ];
        $response = $client->sendMany($wires);
        $account = $response->getAccount();
        $this->assertEquals($this->address, $account->getAddress());

        $tx = $response->getTx();
        $expectedAmount = $amount * count($wires);
        $this->assertEquals($expectedAmount, $tx->getDeduct() - $tx->getFee());
        $this->assertInternalType("string", $tx->getId());
    }
}
