<?php

namespace Adshares\Ads\Tests\E2E;

use Adshares\Ads\AdsClient;
use Adshares\Ads\Driver\CliDriver;
use Adshares\Ads\Driver\CommandError;
use Adshares\Ads\Exception\CommandException;

class MessagesTest extends \PHPUnit\Framework\TestCase
{
    private $address = "0001-00000000-9B6F";
    private $secret = "BB3425F914CA9F661CA6F3B908E07092B5AFB7F2FDAE2E94EDE12C83207CA743";
    private $host = "10.69.3.43";
    private $port = 9001;

    const TRANSACTION_TYPES = [
        'account_created',
        'broadcast',
        'change_account_key',
        'change_node_key',
        'connection',
        'create_account',
        'create_node',
        'empty',
        'log_account',
        'retrieve_funds',
        'send_many',
        'send_one',
        'set_account_status',
        'set_node_status',
        'unset_account_status',
        'unset_node_status',
    ];

    public function testGetMessageIdsWithoutTime()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $this->checkMessageIds($client, null);
    }

    public function testGetMessageIds()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $response = $client->getMe();
        $blockTime = $response->getPreviousBlockTime();
        $blockTime = $blockTime->getTimestamp();
        $blockTime = dechex($blockTime);

        $this->checkMessageIds($client, $blockTime);
    }

    public function testGetMessageIdsFromInvalidBlock()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $this->expectException(CommandException::class);
        $this->expectExceptionCode(CommandError::NO_MESSAGE_LIST_FILE);
        $client->getMessageIds('10000000');
    }

    public function testGetMessageFromInvalidBlock()
    {
        $driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
        $client = new AdsClient($driver);

        $this->expectException(CommandException::class);
        $this->expectExceptionCode(CommandError::BAD_LENGTH);
        $client->getMessage('0001:00000001', '10000000');
    }

    /**
     * @param AdsClient $client
     * @param string|null $blockTime
     */
    protected function checkMessageIds(AdsClient $client, ?string $blockTime): void
    {
        $messageIds = [];
        $isMessageList = false;
        do {
            try {
                $response = $client->getMessageIds($blockTime);
                $messageIds = $response->getMessageIds();
                $isMessageList = true;
            } catch (CommandException $ce) {
                $this->assertEquals(CommandError::NO_MESSAGE_LIST_FILE, $ce->getCode());
                sleep(4);
            }
        } while (!$isMessageList);

        $this->assertGreaterThan(0, count($messageIds));
        foreach ($messageIds as $messageId) {
            $response = $client->getMessage($messageId);

            $message = $response->getMessage();
            $this->assertNotNull($message);

            $transactions = $response->getTransactions();

            /* @var \Adshares\Ads\Entity\Transaction\AbstractTransaction $transaction */
            foreach ($transactions as $transaction) {
                $type = $transaction->getType();
                $this->assertContains($type, self::TRANSACTION_TYPES);
            }
        }
    }
}
