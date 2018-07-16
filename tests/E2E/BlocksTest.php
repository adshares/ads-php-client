<?php

namespace Adshares\Ads\Tests\E2E;

use Adshares\Ads\AdsClient;
use Adshares\Ads\Driver\CliDriver;
use Adshares\Ads\Driver\CommandError;
use Adshares\Ads\Exception\CommandException;

class BlocksTest extends \PHPUnit\Framework\TestCase
{
    private $address = "0001-00000000-9B6F";
    private $secret = "BB3425F914CA9F661CA6F3B908E07092B5AFB7F2FDAE2E94EDE12C83207CA743";
    private $host = "10.69.3.43";
    private $port = 9001;

    public function testGetBlocks()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $attempt = 0;
        $attemptMax = 10;
        while ($attempt < $attemptMax) {
            try {
                $response = $client->getBlocks();
                $blockCount = $response->getUpdatedBlocks();
                if (0 === $blockCount) {
                    break;
                }
                $blocks = $response->getBlocks();
                $this->assertCount($blockCount, $blocks);
//                foreach ($blocks as $block) {
//                    echo $block . "\n";
//                }
            } catch (CommandException $ce) {
                $this->assertEquals(CommandError::GET_SIGNATURE_UNAVAILABLE, $ce->getCode());
                sleep(4);
            }
            $attempt++;
        }
        $this->assertLessThan($attemptMax, $attempt, "Didn't update blocks in expected attempts.");
    }

    public function testGetPackageList()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $response = $client->getMe();
        $blockTime = $response->getPreviousBlockTime();
        $blockTime = $blockTime->getTimestamp();

        $blockTime = dechex($blockTime);

        $packages = [];
        $isMessageList = false;
        do {
            try {
                $response = $client->getPackageList($blockTime);
                $packages = $response->getPackages();
                $isMessageList = true;
            } catch (CommandException $ce) {
                $this->assertEquals(CommandError::NO_MESSAGE_LIST_FILE, $ce->getCode());
                sleep(4);
            }
        } while (!$isMessageList);

        $this->assertGreaterThan(0, count($packages));
        foreach ($packages as $package) {
            /* @var \Adshares\Ads\Entity\Package $package */
            echo $package->getNode() . '-' . $package->getNodeMsid() . "\n";

            $response = $client->getPackage($package->getNode(), $package->getNodeMsid(), $blockTime);
            $transactions = $response->getTransactions();
            foreach ($transactions as $transaction) {
                /* @var \Adshares\Ads\Entity\Transaction\AbstractTransaction $transaction */
                echo "\t" . $transaction->getType() . '-' . $transaction->getId() . "\n";
                if ('connection' ===$transaction->getType() ) {
                    /* @var \Adshares\Ads\Entity\Transaction\ConnectionTransaction $connectionTx */
                    $connectionTx = $transaction;
                    $ipAddress = $connectionTx->getIpAddress();
                    $port = $connectionTx->getPort();
                    echo "\t\t$ipAddress:$port\n";
                }
            }
        }
    }
}
