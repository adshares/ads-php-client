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

namespace Adshares\Ads\Tests\Unit\Entity;

use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Entity\Node;

class NodeTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateFromRow(): void
    {
        /* @var Node $node */
        $node = EntityFactory::createNode($this->getRawData());

        $this->assertInstanceOf(Node::class, $node);
        $this->assertEquals('0001', $node->getId());
        $this->assertEquals('73A5C92FA5142599B1C9863B43E026AFEFA6B57AEE8D189241C7F50C90BA5122', $node->getPublicKey());
        $this->assertEquals('B1C1E0BF92C7C398BD885269F6912EFC22810477065E8C5BF6B5AC8DC05FEC1F', $node->getHash());
        $this->assertEquals(
            '14AC6CA024A5FBF06251554849BD9B9521B348A63DBEAE57E59DC4C85E00B64A',
            $node->getMessageHash()
        );
        $this->assertEquals(8, $node->getMsid());
        $this->assertEquals(new \DateTime('@1530535574'), $node->getMtim());
        $this->assertEquals(254152169691701433, $node->getBalance());
        $this->assertEquals(6, $node->getStatus());
        $this->assertEquals(false, $node->isStatusDeleted());
        $this->assertEquals(true, $node->isStatusVip());
        $this->assertEquals(true, $node->isStatusMostFunds());
        $this->assertEquals(20, $node->getAccountCount());
        $this->assertEquals(8001, $node->getPort());
        $this->assertEquals('172.16.222.101', $node->getIpv4());
    }

    private function getRawData(): array
    {
        return json_decode('{
            "id": "0001",
            "public_key": "73A5C92FA5142599B1C9863B43E026AFEFA6B57AEE8D189241C7F50C90BA5122",
            "hash": "B1C1E0BF92C7C398BD885269F6912EFC22810477065E8C5BF6B5AC8DC05FEC1F",
            "message_hash": "14AC6CA024A5FBF06251554849BD9B9521B348A63DBEAE57E59DC4C85E00B64A",
            "msid": "8",
            "mtim": "1530535574",
            "balance": "2541521.69691701433",
            "status": "6",
            "account_count": "20",
            "port": "8001",
            "ipv4": "172.16.222.101"
        }', true);
    }
}
