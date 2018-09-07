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

namespace Adshares\Ads\Tests\Unit\Response;

use Adshares\Ads\Entity\NetworkTx;
use Adshares\Ads\Entity\Transaction\AbstractTransaction;
use Adshares\Ads\Entity\Tx;
use Adshares\Ads\Response\GetTransactionResponse;
use Adshares\Ads\Tests\Unit\Raw;

class GetTransactionResponseTest extends \PHPUnit\Framework\TestCase
{
    public function testGetTransactionFromRaw()
    {
        $response = new GetTransactionResponse($this->getRawData());
        $time = new \DateTime();
        $time->setTimestamp(1532347520);
        $this->assertEquals($time, $response->getCurrentBlockTime());
        $time->setTimestamp(1532347488);
        $this->assertEquals($time, $response->getPreviousBlockTime());

        $this->assertInstanceOf(Tx::class, $response->getTx());
        $this->assertInstanceOf(NetworkTx::class, $response->getNetworkTx());
        $transaction = $response->getTxn();
        $this->assertInstanceOf(AbstractTransaction::class, $transaction);

        $this->assertEquals('send_one', $transaction->getType());
        $this->assertEquals('5B55C460', $transaction->getBlockId());
        $this->assertEquals('0001:00000003:0001', $transaction->getId());
        $this->assertEquals(125, $transaction->getSize());
        $this->assertEquals('0001', $transaction->getNodeId());
        $this->assertEquals('0001:00000003', $transaction->getMessageId());
    }

    private function getRawData(): array
    {
        return json_decode(Raw::getTransactionSendOne(), true);
    }
}
