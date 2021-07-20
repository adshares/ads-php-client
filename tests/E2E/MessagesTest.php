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

use Adshares\Ads\AdsClient;
use Adshares\Ads\Driver\CommandError;
use Adshares\Ads\Exception\CommandException;
use PHPUnit\Framework\TestCase;

class MessagesTest extends TestCase
{
    private const TRANSACTION_TYPES = [
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
        $client = new TestAdsClient();
        $this->checkMessageIds($client, null);
    }

    public function testGetMessageIds()
    {
        $client = new TestAdsClient();

        $response = $client->getMe();
        $blockTime = $response->getPreviousBlockTime();
        $blockTime = $blockTime->getTimestamp();
        $blockTime = dechex($blockTime);

        $this->checkMessageIds($client, $blockTime);
    }

    public function testGetMessageIdsFromInvalidBlock()
    {
        $client = new TestAdsClient();

        $this->expectException(CommandException::class);
        $this->expectExceptionCode(CommandError::NO_MESSAGE_LIST_FILE);
        $client->getMessageIds('10000000');
    }

    public function testGetMessageFromInvalidBlock()
    {
        $client = new TestAdsClient();

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
            foreach ($transactions as $transaction) {
                $type = $transaction->getType();
                $this->assertContains($type, self::TRANSACTION_TYPES);
            }
        }
    }
}
