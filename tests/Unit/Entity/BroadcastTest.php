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
use DateTime;
use PHPUnit\Framework\TestCase;

class BroadcastTest extends TestCase
{
    public function testCreateFromRow(): void
    {
        $broadcast = EntityFactory::createBroadcast($this->getRawData());

        $blockTime = new DateTime();
        $blockTime->setTimestamp(1532100320);
        $this->assertEquals($blockTime, $broadcast->getBlockTime());
        $this->assertEquals('0001-00000000-9B6F', $broadcast->getAddress());
        $this->assertEquals(1, $broadcast->getAccountMsid());
        $this->assertEquals(1, $broadcast->getNode());
        $this->assertEquals('0001', $broadcast->getNodeId());
        $time = new DateTime();
        $time->setTimestamp(1532100323);
        $this->assertEquals($time, $broadcast->getTime());
        $this->assertEquals('0301000000000001000000E3FE515B0100', $broadcast->getData());
        $this->assertEquals('FE', $broadcast->getMessage());
        $this->assertEquals(
            '1FB7A83994767C48F19EBB00946A3E96883FC4E7BE5F2AED3A0111F04FA58CC3'
            . '4D14D3CD93AA4F5EFCCC86D3C14A222989263B40D5F3BB3A6DA858818497BE00',
            $broadcast->getSignature()
        );
        $this->assertEquals(
            'CD3CC372397CFE14F62BF0CD3300DD3C18360A10846E1CBF28E53E6D01C0FCBB',
            $broadcast->getInputHash()
        );
        $this->assertEquals(
            'A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363',
            $broadcast->getPublicKey()
        );
        $this->assertEquals(true, $broadcast->isVerificationPassed());
        $this->assertEquals(3, $broadcast->getNodeMsid());
        $this->assertEquals(2, $broadcast->getNodeMpos());
        $this->assertEquals('0001:00000003:0002', $broadcast->getId());
        $this->assertEquals(10000, $broadcast->getFee());
    }

    /**
     * @return string[]
     */
    private function getRawData(): array
    {
        return json_decode(
            '{
            "block_time": "1532100320",
            "block_date": "2018-07-20 17:25:20",
            "node": "1",
            "account": "0",
            "address": "0001-00000000-9B6F",
            "account_msid": "1",
            "time": "1532100323",
            "date": "2018-07-20 17:25:23",
            "data": "0301000000000001000000E3FE515B0100",
            "message": "FE",
            "signature": "1FB7A83994767C48F19EBB00946A3E96883FC4E7BE5F2AED3A0111F04FA58CC3'
            . '4D14D3CD93AA4F5EFCCC86D3C14A222989263B40D5F3BB3A6DA858818497BE00",
            "input_hash": "CD3CC372397CFE14F62BF0CD3300DD3C18360A10846E1CBF28E53E6D01C0FCBB",
            "public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
            "verify": "passed",
            "node_msid": "3",
            "node_mpos": "2",
            "id": "0001:00000003:0002",
            "fee": "0.00000010000"
        }',
            true
        );
    }
}
