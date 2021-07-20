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

class AccountTest extends TestCase
{
    public function testCreateFromRow(): void
    {
        $account = EntityFactory::createAccount($this->getRawData());

        $this->assertEquals('0001-00000000-9B6F', $account->getAddress());
        $this->assertEquals(1, $account->getNode());
        $this->assertEquals('0001', $account->getNodeId());
        $this->assertEquals(4, $account->getMsid());
        $this->assertEquals(new DateTime('@1531394984'), $account->getTime());
        $this->assertEquals('0001-00000003-AB0C', $account->getPairedAddress());
        $this->assertEquals(1, $account->getPairedNode());
        $this->assertEquals('0001', $account->getPairedNodeId());
        $this->assertEquals(0, $account->getStatus());
        $this->assertEquals(new DateTime('@1531394976'), $account->getLocalChange());
        $this->assertEquals(new DateTime('@1531396672'), $account->getRemoteChange());
        $this->assertEquals(1999999999743316130, $account->getBalance());
        $this->assertEquals(
            'A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363',
            $account->getPublicKey()
        );
        $this->assertEquals('811F420FDC7FA662BE1A0B7295C88BAD3307C337129A1A52D9A1598FD8486009', $account->getHash());
        $this->assertEquals(false, $account->isStatusDeleted());
    }

    /**
     * @return string[]
     */
    private function getRawData(): array
    {
        return json_decode(
            '{
            "address": "0001-00000000-9B6F",
            "node": "1",
            "id": "0",
            "msid": "4",
            "time": "1531394984",
            "date": "2018-07-12 11:29:44",
            "status": "0",
            "paired_node": "1",
            "paired_id": "3",
            "paired_address": "0001-00000003-AB0C",
            "local_change": "1531394976",
            "remote_change": "1531396672",
            "balance": "19999999.99743316130",
            "public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
            "hash": "811F420FDC7FA662BE1A0B7295C88BAD3307C337129A1A52D9A1598FD8486009"
        }',
            true
        );
    }
}
