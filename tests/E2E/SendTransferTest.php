<?php
/**
 * Copyright (C) 2018 Adshares sp. z o.o.
 *
 * This file is part of ADS PHP Client
 *
 * ADS PHP Client is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ADS PHP Client is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ADS PHP Client.  If not, see <https://www.gnu.org/licenses/>
 */

namespace Adshares\Ads\Tests\E2E;

use Adshares\Ads\AdsClient;
use Adshares\Ads\Command\SendManyCommand;
use Adshares\Ads\Command\SendOneCommand;
use Adshares\Ads\Driver\CliDriver;

class SendTransferTest extends \PHPUnit\Framework\TestCase
{
    private $address = '0001-00000000-9B6F';
    private $secret = 'BB3425F914CA9F661CA6F3B908E07092B5AFB7F2FDAE2E94EDE12C83207CA743';
    private $host = '10.69.3.43';
    private $port = 9001;

    public function testSendOne()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $amount = 1;
        $message = '0000111122223333444455556666777700001111222233334444555566667777';

        $command = new SendOneCommand($this->address, $amount, $message);
        $response = $client->runTransaction($command);
        $account = $response->getAccount();
        $this->assertEquals($this->address, $account->getAddress());

        $tx = $response->getTx();
        $this->assertNotNull($tx->getAccountMsid());
        $this->assertNotNull($tx->getAccountHashin());
        $this->assertEquals($amount, $tx->getDeduct() - $tx->getFee());
        $this->assertInternalType('string', $tx->getId());
    }

    public function testSendOneDryRunShareCommand()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $amount = 1;
        $message = '0000111122223333444455556666777700001111222233334444555566667777';

        $command = new SendOneCommand($this->address, $amount, $message);
        $command->setTimestamp(1);

        $txDryRun = $client->runTransaction($command, true)->getTx();
        $this->assertNotNull($txDryRun->getAccountHashin());
        $this->assertNotNull($txDryRun->getAccountMsid());
        $this->assertNotNull($txDryRun->getData());
        $this->assertNotNull($txDryRun->getSignature());

        $tx = $client->runTransaction($command, false)->getTx();
        $this->assertNotNull($tx->getAccountHashin());
        $this->assertNotNull($tx->getAccountMsid());
        $this->assertNotNull($tx->getData());
        $this->assertNotNull($tx->getSignature());

        $this->assertEquals($txDryRun->getAccountHashin(), $tx->getAccountHashin());
        $this->assertEquals($txDryRun->getAccountMsid(), $tx->getAccountMsid());
        $this->assertEquals($txDryRun->getData(), $tx->getData());
        $this->assertEquals($txDryRun->getSignature(), $tx->getSignature());
    }

    public function testSendOneDryRunSeparateCommand()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $amount = 1;
        $message = '0000111122223333444455556666777700001111222233334444555566667777';

        $command = new SendOneCommand($this->address, $amount, $message);
        $command->setTimestamp(1);

        $txDryRun = $client->runTransaction($command, true)->getTx();
        $this->assertNotNull($txDryRun->getData());
        $this->assertNotNull($txDryRun->getSignature());
        $this->assertNull($txDryRun->getId());
        $signature = $txDryRun->getSignature();

        // create other command
        $command2 = new SendOneCommand($this->address, $amount, $message);
        $command2->setTimestamp(1);
        $command2->setSignature($signature);

        $tx = $client->runTransaction($command2, false)->getTx();
        $this->assertNotNull($tx->getData());
        $this->assertNotNull($tx->getSignature());
        $this->assertNotNull($tx->getId());

        $this->assertEquals($txDryRun->getData(), $tx->getData());
        $this->assertEquals($txDryRun->getSignature(), $tx->getSignature());
    }

    public function testSendMany()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $amount = 1;
        $wires = [
            '0001-00000000-XXXX' => $amount,
            '0001-00000001-XXXX' => $amount,
            '0002-00000000-XXXX' => $amount,
            '0002-00000001-XXXX' => $amount,
        ];
        $command = new SendManyCommand($wires);
        $response = $client->runTransaction($command);
        $account = $response->getAccount();
        $this->assertEquals($this->address, $account->getAddress());

        $tx = $response->getTx();
        $expectedAmount = $amount * count($wires);
        $this->assertEquals($expectedAmount, $tx->getDeduct() - $tx->getFee());
        $this->assertInternalType('string', $tx->getId());
    }

    public function testSendManyDryRun()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $amount = 1;
        $wires = [
            '0001-00000000-XXXX' => $amount,
            '0001-00000001-XXXX' => $amount,
            '0002-00000000-XXXX' => $amount,
            '0002-00000001-XXXX' => $amount,
        ];
        $command = new SendManyCommand($wires);
        $command->setTimestamp(1);

        $txDryRun = $client->runTransaction($command, true)->getTx();
        $this->assertNotNull($txDryRun->getAccountHashin());
        $this->assertNotNull($txDryRun->getAccountMsid());
        $this->assertNotNull($txDryRun->getData());

        $tx = $client->runTransaction($command, false)->getTx();
        $this->assertNotNull($tx->getAccountHashin());
        $this->assertNotNull($tx->getAccountMsid());
        $this->assertNotNull($tx->getData());

        $this->assertEquals($txDryRun->getAccountHashin(), $tx->getAccountHashin());
        $this->assertEquals($txDryRun->getAccountMsid(), $tx->getAccountMsid());
        $this->assertEquals($txDryRun->getData(), $tx->getData());
    }
}
