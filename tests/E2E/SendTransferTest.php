<?php

/**
 * Copyright (c) 2018-2021 Adshares sp. z o.o.
 *
 * This file is part of ADS PHP Client
 *
 * ADS PHP Client is free software: you can redistribute and/or modify it
 * under the terms of the GNU General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ADS PHP Client is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ADS PHP Client. If not, see <https://www.gnu.org/licenses/>
 */

namespace Adshares\Ads\Tests\E2E;

use Adshares\Ads\Command\SendManyCommand;
use Adshares\Ads\Command\SendOneCommand;
use PHPUnit\Framework\TestCase;

class SendTransferTest extends TestCase
{
    public function testSendOne(): void
    {
        $client = new TestAdsClient();

        $amount = 1;
        $message = '0000111122223333444455556666777700001111222233334444555566667777';

        $command = new SendOneCommand($client->getAddress(), $amount, $message);
        $response = $client->runTransaction($command);
        $account = $response->getAccount();
        $this->assertEquals($client->getAddress(), $account->getAddress());

        $tx = $response->getTx();
        $this->assertNotNull($tx->getAccountMsid());
        $this->assertNotNull($tx->getAccountHashin());
        $this->assertEquals($amount, $tx->getDeduct() - $tx->getFee());
        $this->assertIsString($tx->getId());
    }

    public function testSendOneDryRunShareCommand(): void
    {
        $client = new TestAdsClient();

        $amount = 1;
        $message = '0000111122223333444455556666777700001111222233334444555566667777';

        $command = new SendOneCommand($client->getAddress(), $amount, $message);
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

    public function testSendOneDryRunSeparateCommand(): void
    {
        $client = new TestAdsClient();

        $amount = 1;
        $message = '0000111122223333444455556666777700001111222233334444555566667777';

        $command = new SendOneCommand($client->getAddress(), $amount, $message);
        $command->setTimestamp(1);

        $txDryRun = $client->runTransaction($command, true)->getTx();
        $this->assertNotNull($txDryRun->getData());
        $this->assertNotNull($txDryRun->getSignature());
        $this->assertNull($txDryRun->getId());
        $signature = $txDryRun->getSignature();

        // create other command
        $command2 = new SendOneCommand($client->getAddress(), $amount, $message);
        $command2->setTimestamp(1);
        $command2->setSignature($signature);

        $tx = $client->runTransaction($command2, false)->getTx();
        $this->assertNotNull($tx->getData());
        $this->assertNotNull($tx->getSignature());
        $this->assertNotNull($tx->getId());

        $this->assertEquals($txDryRun->getData(), $tx->getData());
        $this->assertEquals($txDryRun->getSignature(), $tx->getSignature());
    }

    public function testSendMany(): void
    {
        $client = new TestAdsClient();

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
        $this->assertEquals($client->getAddress(), $account->getAddress());

        $tx = $response->getTx();
        $expectedAmount = $amount * count($wires);
        $this->assertEquals($expectedAmount, $tx->getDeduct() - $tx->getFee());
        $this->assertIsString($tx->getId());
    }

    public function testSendManyDryRun(): void
    {
        $client = new TestAdsClient();

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
