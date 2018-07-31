<?php
/**
 * Copyright (C) 2018 Adshares sp. z. o.o.
 *
 * This file is part of PHP ADS Client
 *
 * PHP ADS Client is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * PHP ADS Client is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with PHP ADS Client.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace Adshares\Ads\Tests\Unit\Entity\Transaction;

use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Entity\Transaction\ConnectionTransaction;

class ConnectionTransactionTest extends \PHPUnit\Framework\TestCase
{
    public function testConnectionFromRaw(): void
    {
        $blockId = '5B4F1D60';
        $messageId = '0002:00000449';
        $nodeId = '0002';

        $data = $this->getRawConnection();
        $data['block_id'] = $blockId;
        $data['message_id'] = $messageId;
        $data['node_id'] = $nodeId;
        /* @var ConnectionTransaction $transaction */
        $transaction = EntityFactory::createTransaction($data);

        $this->assertEquals('0001:0000001F:0002', $transaction->getId());
        $this->assertEquals('connection', $transaction->getType());
        $this->assertEquals(8001, $transaction->getPort());
        $this->assertEquals('10.69.3.43', $transaction->getIpAddress());
        $this->assertEquals('master@4feb5a0', $transaction->getVersion());
        $this->assertEquals(23, $transaction->getSize());

        $this->assertEquals($blockId, $transaction->getBlockId());
        $this->assertEquals($messageId, $transaction->getMessageId());
        $this->assertEquals($nodeId, $transaction->getNodeId());
    }

    private function getRawConnection(): array
    {
        return json_decode('{
            "id": "0001:0000001F:0002",
            "type": "connection",
            "port": "8001",
            "ip_address": "10.69.3.43",
            "version": "master@4feb5a0",
            "size": "23"
        }', true);
    }
}
