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

namespace Adshares\Ads\Tests\Unit\Entity;

use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Entity\Node;
use DateTime;
use PHPUnit\Framework\TestCase;

class BlockTest extends TestCase
{
    public function testCreateFromRow(): void
    {
        $block = EntityFactory::createBlock($this->getRawData());

        $this->assertEquals(12300000000, $block->getDividendBalance());
        $this->assertEquals(true, $block->isDividendPay());
        $this->assertEquals('5B3A1E80', $block->getId());
        $this->assertEquals(27, $block->getMessageCount());
        $this->assertEquals('41FB7933B8BE623E0D8C087E0AAC91F56999AB892ED1DC9B1DCB39D057427639', $block->getMinHash());
        $this->assertEquals('F41152F6FDB5C50697B1BCF8562F35848C7D679CAC8A69883341FF55040B684B', $block->getMsgHash());
        $this->assertEquals(2, $block->getNodeCount());
        $this->assertEquals('DEE608AFF65371FD14AC7118528BAAAF620931B2B261E5964C632B908D1C57EA', $block->getNodHash());
        $this->assertEquals('DDD2F343184A8BFF7FC9DE1704B9956D89B0573D7C27FE1F55D9646470B8B12C', $block->getNowHash());
        $this->assertEquals('91655C4B8EA51E66E81F079A8C520EBB9097A44D74EEFC310C79BEDABC4204EF', $block->getOldHash());
        $this->assertEquals(new DateTime('@1530535552'), $block->getTime());
        $this->assertEquals('23A7002738367EC99A7BD2988720FF0824580219D2502226084E1BCE11A0B634', $block->getVipHash());
        $this->assertEquals(1, $block->getVoteNo());
        $this->assertEquals(7, $block->getVoteTotal());
        $this->assertEquals(3, $block->getVoteYes());


        $nodes = $block->getNodes();
        $this->assertCount(2, $nodes);
        $node = $nodes[0];
        $this->assertInstanceOf(Node::class, $node);
        $this->assertEquals('0000', $node->getId());
    }

    /**
     * @return array<string, array<int|string, array<int|string, string>|string>|string>
     */
    private function getRawData(): array
    {
        return json_decode(
            '{
            "id": "5B3A1E80",
            "time": "1530535552",
            "message_count": "27",
            "oldhash": "91655C4B8EA51E66E81F079A8C520EBB9097A44D74EEFC310C79BEDABC4204EF",
            "minhash": "41FB7933B8BE623E0D8C087E0AAC91F56999AB892ED1DC9B1DCB39D057427639",
            "msghash": "F41152F6FDB5C50697B1BCF8562F35848C7D679CAC8A69883341FF55040B684B",
            "nodhash": "DEE608AFF65371FD14AC7118528BAAAF620931B2B261E5964C632B908D1C57EA",
            "viphash": "23A7002738367EC99A7BD2988720FF0824580219D2502226084E1BCE11A0B634",
            "nowhash": "DDD2F343184A8BFF7FC9DE1704B9956D89B0573D7C27FE1F55D9646470B8B12C",
            "vote_yes": "3",
            "vote_no": "1",
            "vote_total": "7",
            "node_count": "2",
            "dividend_balance": "0.12300000000",
            "dividend_pay": "true",
            "nodes": [
                {
                    "id": "0000",
                    "public_key": "0000000000000000000000000000000000000000000000000000000000000000",
                    "hash": "0000000000000000000000000000000000000000000000000000000000000000",
                    "message_hash": "D18D1A21A546508BE4F2B5EF6F51981D7D2B55E46EE2EF1DE6911F8E9B2AD84D",
                    "msid": "0",
                    "mtim": "1530535488",
                    "balance": "0.00000000000",
                    "status": "0",
                    "account_count": "0",
                    "port": "0",
                    "ipv4": "0.0.0.0"
                }, {
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
                }
            ]
        }',
            true
        );
    }
}
