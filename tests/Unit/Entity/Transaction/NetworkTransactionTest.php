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

namespace Adshares\Ads\Tests\Unit\Entity\Transaction;

use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Entity\Transaction\NetworkTransaction;
use DateTime;
use PHPUnit\Framework\TestCase;

class NetworkTransactionTest extends TestCase
{
    public function testCreateAccountFromRaw(): void
    {
        /** @var NetworkTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawCreateAccount());

        $this->assertEquals('0001:0000000E:0001', $transaction->getId());
        $this->assertEquals('create_account', $transaction->getType());
        $this->assertEquals(1, $transaction->getNode());
        $this->assertEquals(0, $transaction->getUser());
        $this->assertEquals(976, $transaction->getMsgId());
        $this->assertEquals('0001-00000000-9B6F', $transaction->getSenderAddress());
        $date = new DateTime();
        $date->setTimestamp(1531495703);
        $this->assertEquals($date, $transaction->getTime());
        $this->assertNull($transaction->getTargetAddress());
        $this->assertEquals(1, $transaction->getTargetNode());
        $this->assertEquals('0001', $transaction->getTargetNodeId());
        $this->assertEquals(
            'EBAEE201D66CD2E0B68DEE9A869FFBD14986E17770A3DA62779B6F06D0030000'
            . 'A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363',
            $transaction->getSignature()
        );
        $this->assertEquals(117, $transaction->getSize());
    }

    public function testCreateNodeFromRaw(): void
    {
        /** @var NetworkTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawCreateNode());

        $this->assertEquals('0001:00000009:0001', $transaction->getId());
        $this->assertEquals('create_node', $transaction->getType());
        $this->assertEquals(1, $transaction->getNode());
        $this->assertEquals(0, $transaction->getUser());
        $this->assertEquals(1, $transaction->getMsgId());
        $this->assertEquals('0001-00000000-9B6F', $transaction->getSenderAddress());
        $date = new DateTime();
        $date->setTimestamp(1531496775);
        $this->assertEquals($date, $transaction->getTime());
        $this->assertNull($transaction->getTargetAddress());
        $this->assertNull($transaction->getTargetNode());
        $this->assertNull($transaction->getTargetNodeId());
        $this->assertEquals(
            '72F344B3F1E8C225C708CB1B6ACE62F9F776081F4C4F21BA25944350847EDA14'
            . '56C29F874BA3C9FCC367EDD13C148175946AA1D2D46EF1BBDD49FFE0507E640D',
            $transaction->getSignature()
        );
        $this->assertEquals(79, $transaction->getSize());
    }

    public function testRetrieveFundsFromRaw(): void
    {
        /** @var NetworkTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawRetrieveFunds());

        $this->assertEquals('0001:0000000F:0001', $transaction->getId());
        $this->assertEquals('retrieve_funds', $transaction->getType());
        $this->assertEquals(1, $transaction->getNode());
        $this->assertEquals(0, $transaction->getUser());
        $this->assertEquals(1003, $transaction->getMsgId());
        $this->assertEquals('0001-00000000-9B6F', $transaction->getSenderAddress());
        $date = new DateTime();
        $date->setTimestamp(1531495739);
        $this->assertEquals($date, $transaction->getTime());
        $this->assertEquals('0002-00000001-659C', $transaction->getTargetAddress());
        $this->assertEquals(2, $transaction->getTargetNode());
        $this->assertEquals('0002', $transaction->getTargetNodeId());
        $this->assertEquals(1, $transaction->getTargetUser());

        $this->assertEquals(
            'CC05D9CE1816197AB8A02335CBB7ED0056DA088A4CFA593022679360B750E525'
            . '2EA1B1A0531398A3902FEF7B802F98AA6B1C417FB469F092A88508EBCAC5660A',
            $transaction->getSignature()
        );
        $this->assertEquals(85, $transaction->getSize());
    }

    /**
     * @return string[]
     */
    private function getRawCreateAccount(): array
    {
        return json_decode(
            '{
			"id": "0001:0000000E:0001",
			"type": "create_account",
			"node": "1",
			"user": "0",
			"msg_id": "976",
			"time": "1531495703",
			"target_node": "1",
			"signature": "EBAEE201D66CD2E0B68DEE9A869FFBD14986E17770A3DA62779B6F06D0030000'
            . 'A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
			"size": "117"
		}',
            true
        );
    }

    /**
     * @return string[]
     */
    private function getRawCreateNode(): array
    {
        return json_decode(
            '{
			"id": "0001:00000009:0001",
			"type": "create_node",
			"node": "1",
			"user": "0",
			"msg_id": "1",
			"time": "1531496775",
			"signature": "72F344B3F1E8C225C708CB1B6ACE62F9F776081F4C4F21BA25944350847EDA14'
            . '56C29F874BA3C9FCC367EDD13C148175946AA1D2D46EF1BBDD49FFE0507E640D",
			"size": "79"
		}',
            true
        );
    }

    /**
     * @return string[]
     */
    private function getRawRetrieveFunds(): array
    {
        return json_decode(
            '{
			"id": "0001:0000000F:0001",
			"type": "retrieve_funds",
			"node": "1",
			"user": "0",
			"msg_id": "1003",
			"time": "1531495739",
			"target_node": "2",
			"target_user": "1",
			"signature": "CC05D9CE1816197AB8A02335CBB7ED0056DA088A4CFA593022679360B750E525'
            . '2EA1B1A0531398A3902FEF7B802F98AA6B1C417FB469F092A88508EBCAC5660A",
			"size": "85"
		}',
            true
        );
    }
}
