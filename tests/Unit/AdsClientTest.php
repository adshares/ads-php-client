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

namespace Adshares\Ads\Tests\Unit;

use Adshares\Ads\AdsClient;
use Adshares\Ads\Command\CreateAccountCommand;
use Adshares\Ads\Command\CreateNodeCommand;
use Adshares\Ads\Command\SendOneCommand;
use Adshares\Ads\Driver\CliDriver;
use Adshares\Ads\Entity\Broadcast;
use Adshares\Ads\Tests\Unit\Entity\ExtendedAccount;
use Symfony\Component\Process\Process;

class AdsClientTest extends \PHPUnit\Framework\TestCase
{
    private $address = '0001-00000000-9B6F';
    private $secret = 'BB3425F914CA9F661CA6F3B908E07092B5AFB7F2FDAE2E94EDE12C83207CA743';
    private $host = '10.69.3.43';
    private $port = 9001;

    public function testCreateAccount()
    {
        $client = $this->createAdsClient(0, $this->stripNewLine(Raw::createAccount()));
        $command = new CreateAccountCommand();
        $command->setLastMsid(3);
        $command->setLastHash('CDE7C5D0D243D60500BDD32A8FC2A9EA7E9F7631B6CCFE77C26521A323087665');
        $response = $client->createAccount($command);
        $account = $response->getAccount();
        $this->assertEquals('0002-00000000-75BD', $account->getAddress());

        $newAccount = $response->getNewAccount();
        $this->assertEquals('0002-00000004-3539', $newAccount->getAddress());
        $this->assertEquals('2', $newAccount->getNode());
        $this->assertEquals('0002', $newAccount->getNodeId());
    }

    public function testCreateNode()
    {
        $client = $this->createAdsClient(0, $this->stripNewLine(Raw::createNode()));
        $command = new CreateNodeCommand();
        $command->setLastMsid(3);
        $command->setLastHash('35CABB3B28BA322AE62063024917293549FD6D42BF7ADCC933584F1585025D97');
        $response = $client->runTransaction($command);
        $this->assertEquals('0001-00000000-9B6F', $response->getAccount()->getAddress());
        $this->assertEquals(new \DateTime('@1536734240'), $response->getCurrentBlockTime());
        $this->assertEquals(new \DateTime('@1536734208'), $response->getPreviousBlockTime());
        $this->assertEquals('0001:00000015:0001', $response->getTx()->getId());
    }

    public function testGetAccount()
    {
        $client = $this->createAdsClient(0, $this->stripNewLine(Raw::getAccount()));
        $response = $client->getMe();
        $account = $response->getAccount();
        $this->assertEquals($this->address, $account->getAddress());
    }

    public function testGetAccounts()
    {
        $client = $this->createAdsClient(0, $this->stripNewLine(Raw::getAccounts()));
        $response = $client->getAccounts(1, '5B56E800');
        $this->assertGreaterThan(0, count($response->getAccounts()));
    }

    public function testGetBlock()
    {
        $client = $this->createAdsClient(0, $this->stripNewLine(Raw::getBlock()));
        $response = $client->getBlock('5B56E520');
        $this->assertGreaterThan(1, count($response->getBlock()->getNodes()));
    }

    public function testGetBlockIds()
    {
        $client = $this->createAdsClient(0, $this->stripNewLine(Raw::getBlockIds()));
        $response = $client->getBlockIds('5B56C9E0', '5B56CA60');
        $this->assertEquals($response->getUpdatedBlocks(), count($response->getBlockIds()));
    }

    public function testGetBroadcast()
    {
        $client = $this->createAdsClient(0, $this->stripNewLine(Raw::getBroadcast()));
        $response = $client->getBroadcast('5B55D240');
        $broadcasts = $response->getBroadcast();
        $broadcast = array_shift($broadcasts);
        $this->assertInstanceOf(Broadcast::class, $broadcast);
        if (null !== $broadcast) {
            $this->assertEquals('7E', $broadcast->getMessage());
        }
    }

    public function testGetMe()
    {
        $client = $this->createAdsClient(0, $this->stripNewLine(Raw::getAccount()));
        $response = $client->getMe();
        $account = $response->getAccount();
        $this->assertEquals($this->address, $account->getAddress());
    }

    public function testGetMessage()
    {
        $client = $this->createAdsClient(0, $this->stripNewLine(Raw::getMessage()));
        $messageId = '0003:0000003B';
        $response = $client->getMessage($messageId, '5B50A6A0');
        $this->assertEquals($messageId, $response->getMessage()->getId());
    }

    public function testGetMessageIds()
    {
        $client = $this->createAdsClient(0, $this->stripNewLine(Raw::getMessageIds()));
        $response = $client->getMessageIds('5B51A3E0');
        $this->assertEquals($response->getMessageCount(), count($response->getMessageIds()));
    }

    public function testSendOne()
    {
        $client = $this->createAdsClient(
            0,
            [$this->stripNewLine(Raw::getAccount()), $this->stripNewLine(Raw::sendOne())]
        );
        $command = new SendOneCommand(
            '0001-00000001-8B4E',
            10000000000000,
            '46066ADCA3C787BF6874CE3361EECF7A9969D98F12719DF53440172B5A7D345A'
        );
        $response = $client->runTransaction($command);
        $this->assertNotNull($response->getTx()->getId());
        $this->assertEquals($this->address, $response->getAccount()->getAddress());
    }

    public function testSendOneWithExplicitSender()
    {
        $client = $this->createAdsClient(
            0,
            [$this->stripNewLine(Raw::getAccount()), $this->stripNewLine(Raw::sendOne())]
        );
        $command = new SendOneCommand(
            '0001-00000001-8B4E',
            10000000000000,
            '46066ADCA3C787BF6874CE3361EECF7A9969D98F12719DF53440172B5A7D345A'
        );
        $command->setSender('0001-00000001-8B4E');
        $command->setSignature('DABDDABFC25B0C76E33C0E6285F09695EE0193D10DBBC3F2CA39E8183603D7BDC5'
            . 'F62C14FF60A2EFCC23784F7FA380C6F38A2AD6B7DFB95FA2DCA9BA76D04503');
        $command->setTimestamp((new \DateTime())->getTimestamp());
        $response = $client->runTransaction($command);
        $this->assertNotNull($response->getTx()->getId());
        $this->assertEquals($this->address, $response->getAccount()->getAddress());
    }

    public function testSendOneWithExplicitMsidAndHash()
    {
        $client = $this->createAdsClient(0, $this->stripNewLine(Raw::sendOne()));
        $command = new SendOneCommand(
            '0001-00000001-8B4E',
            10000000000000,
            '46066ADCA3C787BF6874CE3361EECF7A9969D98F12719DF53440172B5A7D345A'
        );
        $command->setLastMsid(3);
        $command->setLastHash('8592795CE4EE7AAEEC7BA0EBCB4E5B83DF0151B009363FECB99EB39B62549343');
        $response = $client->runTransaction($command);
        $this->assertNotNull($response->getTx()->getId());
        $this->assertEquals($this->address, $response->getAccount()->getAddress());
    }

    public function testGetTransaction()
    {
        $client = $this->createAdsClient(0, $this->stripNewLine(Raw::getTransactionSendOne()));
        $txid = '0001:00000003:0001';
        $response = $client->getTransaction($txid);

        $this->assertEquals($txid, $response->getNetworkTx()->getId());
        $this->assertEquals($txid, $response->getTxn()->getId());
    }

    public function testSetEntityMap()
    {
        $entityMap = [
            'Account' => 'Adshares\Ads\Tests\Unit\Entity\ExtendedAccount',
        ];

        $client = $this->createAdsClient(0, $this->stripNewLine(Raw::getAccount()));
        $client::setEntityMap($entityMap);

        $response = $client->getMe();

        /* @var ExtendedAccount $account */
        $account = $response->getAccount();

        $this->assertInstanceOf(ExtendedAccount::class, $account);
        if ($account instanceof ExtendedAccount) {
            $this->assertEquals($this->address, $account->getAddress());
            $this->assertEquals($this->address, $account->getId());
        }
    }

    /**
     * Creates AdsClient with mocked process.
     *
     * @param int $processExitCode exit code returned by process
     * @param string|array $processOutput process output
     * @return AdsClient
     */
    private function createAdsClient(int $processExitCode, $processOutput = ''): AdsClient
    {
        $process = $this->createMock(Process::class);
        $process->method('getExitCode')->willReturn($processExitCode);
        if (is_array($processOutput)) {
            $stub = new \PHPUnit\Framework\MockObject\Stub\ConsecutiveCalls($processOutput);
        } else {
            $stub = $this->onConsecutiveCalls($processOutput);
        }
        $process->method('getOutput')->will($stub);

        $driver = $this->getMockBuilder(CliDriver::class)
            ->setConstructorArgs([$this->address, $this->secret, $this->host, $this->port])
            ->setMethods(['getProcess'])
            ->getMock();
        $driver->method('getProcess')->willReturn($process);
        /* @var CliDriver $driver */
        if ($driver instanceof CliDriver) {
            $client = new AdsClient($driver);
        } else {
            throw new \RuntimeException();
        }

        return $client;
    }

    private function stripNewLine(string $text): string
    {
        return str_replace(["\n", "\r"], '', $text);
    }
}
