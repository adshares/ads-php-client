<?php

namespace Adshares\Ads\Tests\E2E;

use Adshares\Ads\AdsClient;
use Adshares\Ads\Command\BroadcastCommand;
use Adshares\Ads\Driver\CliDriver;
use Adshares\Ads\Driver\CommandError;
use Adshares\Ads\Entity\Broadcast;
use Adshares\Ads\Exception\CommandException;
use Adshares\Ads\Response\GetBroadcastResponse;

class BroadcastTest extends \PHPUnit\Framework\TestCase
{
    const BLOCK_TIME_SECONDS = 32;

    private $address = "0001-00000000-9B6F";
    private $secret = "BB3425F914CA9F661CA6F3B908E07092B5AFB7F2FDAE2E94EDE12C83207CA743";
    private $host = "10.69.3.43";
    private $port = 9001;


    public function testBroadcastWithoutTime()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $this->expectException(CommandException::class);
        $this->expectExceptionCode(CommandError::NO_BROADCAST_FILE);
        $client->getBroadcast();
    }

    public function testBroadcast()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $message = strtoupper("12ab");
        $command = new BroadcastCommand($message);
        $response = $client->runTransaction($command);
        $this->assertEquals($this->address, $response->getAccount()->getAddress());

        $txId = $response->getTx()->getId();

        $this->assertInternalType("string", $txId);

        $blockTime = $response->getCurrentBlockTime();
        $blockTime = $blockTime->getTimestamp();

        $delay = 0;
        $delayMax = 2;
        $nextBlockAttempt = 0;
        $nextBlockAttemptMax = 2;

        /* @var GetBroadcastResponse $getBroadcastResponse */
        $getBroadcastResponse = null;
        sleep(self::BLOCK_TIME_SECONDS);
        do {
            try {
                $from = dechex($blockTime);
                $getBroadcastResponse = $client->getBroadcast($from);
            } catch (CommandException $ce) {
                $exceptionCode = $ce->getCode();
                if (CommandError::BROADCAST_NOT_READY === $exceptionCode) {
                    $this->assertLessThan($delayMax, $delay);
                    sleep(self::BLOCK_TIME_SECONDS);
                    ++$delay;
                } elseif (CommandError::NO_BROADCAST_FILE === $exceptionCode) {
                    $this->assertLessThan($nextBlockAttemptMax, $nextBlockAttempt);
                    $blockTime += self::BLOCK_TIME_SECONDS;
                    ++$nextBlockAttempt;
                }
            }
        } while (null === $getBroadcastResponse);

        /* @var Broadcast $broadcast */
        $broadcast = null;
        if (null !== $getBroadcastResponse) {
            $broadcasts = $getBroadcastResponse->getBroadcast();
            $broadcast = array_shift($broadcasts);
        }
        $this->assertNotNull($broadcast);
        $this->assertInstanceOf(Broadcast::class, $broadcast);
        $this->assertEquals($message, $broadcast->getMessage());
    }
}
