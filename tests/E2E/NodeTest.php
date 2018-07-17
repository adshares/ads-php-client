<?php

namespace Adshares\Ads\Tests\E2E;

use Adshares\Ads\AdsClient;
use Adshares\Ads\Driver\CliDriver;
use Adshares\Ads\Driver\CommandError;
use Adshares\Ads\Exception\CommandException;

class NodeTest extends \PHPUnit\Framework\TestCase
{
    private $address = "0001-00000000-9B6F";
    private $secret = "BB3425F914CA9F661CA6F3B908E07092B5AFB7F2FDAE2E94EDE12C83207CA743";
    private $host = "10.69.3.43";
    private $port = 9001;

    public function testGetBlock()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $response = null;
        $attempt = 0;
        $attemptMax = 10;
        while ((null === $response) && ($attempt < $attemptMax)) {
            try {
                $response = $client->getBlock();
            } catch (CommandException $ce) {
                $this->assertEquals(CommandError::GET_BLOCK_INFO_UNAVAILABLE, $ce->getCode());
                $attempt++;
                sleep(4);
            }
        }
        $this->assertNotNull($response, "Didn't receive block data in expected attempts.");
        if (null !== $response) {
            $block = $response->getBlock();
            $this->assertNotEquals(0, $block->getMessageCount());
            $this->assertGreaterThan(1, count($block->getNodes()));
        }
    }

    public function testGetAccounts()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $response = $client->getAccounts(1);
        $accounts = $response->getAccounts();
        $this->assertGreaterThan(0, count($accounts));
        foreach ($accounts as $account) {
            /* @var \Adshares\Ads\Entity\Account $account */
            echo $account->getAddress() . "\n";
        }
    }

    public function testGetAccountsFromBlock()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $response = $client->getAccounts(1);
        $blockTime = dechex($response->getPreviousBlockTime()->getTimestamp());
        $accounts = $response->getAccounts();
        $response2 = $client->getAccounts(1, $blockTime);
        $accounts2 = $response2->getAccounts();

        $this->assertEquals($accounts2, $accounts);
    }
}
