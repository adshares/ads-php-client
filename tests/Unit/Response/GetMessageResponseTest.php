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

namespace Adshares\Ads\Tests\Unit\Response;

use Adshares\Ads\Entity\Message;
use Adshares\Ads\Entity\Transaction\AbstractTransaction;
use Adshares\Ads\Entity\Tx;
use Adshares\Ads\Response\GetMessageResponse;
use Adshares\Ads\Tests\Unit\Raw;
use DateTime;
use PHPUnit\Framework\TestCase;

class GetMessageResponseTest extends TestCase
{
    public function testGetMessageIdsFromRaw()
    {
        $response = new GetMessageResponse($this->getRawData());
        $time = new DateTime();
        $time->setTimestamp(1532012352);
        $this->assertEquals($time, $response->getCurrentBlockTime());
        $time->setTimestamp(1532012320);
        $this->assertEquals($time, $response->getPreviousBlockTime());

        $this->assertInstanceOf(Tx::class, $response->getTx());
        $this->assertInstanceOf(Message::class, $response->getMessage());
        $transactions = $response->getTransactions();
        $this->assertCount(2, $transactions);
        foreach ($transactions as $transaction) {
            $this->assertInstanceOf(AbstractTransaction::class, $transaction);
        }
    }

    private function getRawData(): array
    {
        return json_decode(Raw::getMessage(), true);
    }
}
