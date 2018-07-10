<?php

namespace Adshares\Ads\Tests\E2E;

use Adshares\Ads\AdsClient;
use Adshares\Ads\Driver\CliDriver;
use Adshares\Ads\Exception\CommandException;

class BlocksTest extends \PHPUnit\Framework\TestCase
{
    /**
     * No new blocks. All blocks were downloaded.
     */
    const NO_NEW_BLOCKS = "No new blocks to download";
    /**
     * No message list. Need to retry after short delay.
     */
    const NO_MESSAGE_LIST_FILE = "No message list file";

    private $address = "0001-00000000-9B6F";
    private $secret = "BB3425F914CA9F661CA6F3B908E07092B5AFB7F2FDAE2E94EDE12C83207CA743";
    private $host = "10.69.3.43";
    private $port = 9001;

    public function testGetBlocks()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        while (true) {
            try {
                $response = $client->getBlocks();

                $blocks = $response->getBlocks();
                foreach ($blocks as $block) {
                    echo $block . "\n";
                }
            } catch (CommandException $ce) {
                $this->assertEquals($ce->getMessage(), self::NO_NEW_BLOCKS);
                break;
            }
        }
    }

    public function testGetMessageList()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $response = $client->getMe();
        $blockTime = $response->getPreviousBlockTime();
        $blockTime = $blockTime->getTimestamp();

        $blockTime = dechex($blockTime);

        $messages = [];
        $isMessageList = false;
        do {
            try {
                $response = $client->getMessageList($blockTime);
                $messages = $response->getMessages();
                $isMessageList = true;
            } catch (CommandException $ce) {
                $this->assertEquals($ce->getMessage(), self::NO_MESSAGE_LIST_FILE);
                sleep(4);
            }
        } while (!$isMessageList);

        $this->assertGreaterThan(0, count($messages));
        foreach ($messages as $message) {
            /* @var \Adshares\Ads\Entity\Message $message */
            echo $message->getNode() . '-' . $message->getNodeMsid() . "\n";

            $response = $client->getMessage($message->getNode(), $message->getNodeMsid(), $blockTime);
            $transactions = $response->getTransactions();
            foreach ($transactions as $transaction) {
                /* @var \Adshares\Ads\Entity\Transaction $transaction */
                echo "\t" . $transaction->getType() . '-' . $transaction->getId() . "\n";
            }
        }
    }
}
