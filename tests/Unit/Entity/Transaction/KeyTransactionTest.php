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
use Adshares\Ads\Entity\Transaction\KeyTransaction;
use DateTime;
use PHPUnit\Framework\TestCase;

class KeyTransactionTest extends TestCase
{
    public function testAccountCreatedFromRaw(): void
    {
        /** @var KeyTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawAccountCreated());

        $this->assertEquals('0002:0000000A:0001', $transaction->getId());
        $this->assertEquals('account_created', $transaction->getType());
        $this->assertEquals(2, $transaction->getNode());
        $this->assertEquals(2, $transaction->getUser());
        $this->assertEquals(0, $transaction->getMsgId());
        $this->assertEquals('0002-00000002-55FF', $transaction->getSenderAddress());
        $date = new DateTime();
        $date->setTimestamp(1531493862);
        $this->assertEquals($date, $transaction->getTime());
        $this->assertEquals('0001-00000000-9B6F', $transaction->getTargetAddress());
        $this->assertEquals(1, $transaction->getTargetNode());
        $this->assertEquals('0001', $transaction->getTargetNodeId());
        $this->assertEquals(0, $transaction->getTargetUser());
        $this->assertEquals(
            'A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363',
            $transaction->getPublicKey()
        );
        $this->assertEquals(53, $transaction->getSize());
    }

    public function testChangeAccountKeyFromRaw(): void
    {
        /** @var KeyTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawChangeAccountKey());

        $this->assertEquals('0001:00000009:0001', $transaction->getId());
        $this->assertEquals('change_account_key', $transaction->getType());
        $this->assertEquals(1, $transaction->getNode());
        $this->assertEquals(0, $transaction->getUser());
        $this->assertEquals(5, $transaction->getMsgId());
        $this->assertEquals('0001-00000000-9B6F', $transaction->getSenderAddress());
        $date = new DateTime();
        $date->setTimestamp(1531498103);
        $this->assertEquals($date, $transaction->getTime());
        $this->assertNull($transaction->getTargetAddress());
        $this->assertNull($transaction->getTargetNode());
        $this->assertNull($transaction->getTargetNodeId());
        $this->assertEquals(
            'EAE1C8793B5597C4B3F490E76AC31172C439690F8EE14142BB851A61F9A49F0E',
            $transaction->getPublicKey()
        );
        $this->assertEquals(
            '01411FAC10DE65000000008100000000000000B04EEF0100000000B04EEF0100'
            . '000000200000000000000020000000000000000000000000000000626C6F636B',
            $transaction->getPublicKeySignature()
        );
        $this->assertEquals(
            '65870B267C50ABE43A63FE7294768C400DB050D455BCEC3E44C64B07F0F18392'
            . '348E7614A088DCC21327BC0A0F009A6A12CCFC070297E8E035C2DA9DA9449303',
            $transaction->getSignature()
        );
        $this->assertEquals(111, $transaction->getSize());
    }

    public function testChangeNodeKeyFromRaw(): void
    {
        /** @var KeyTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawChangeNodeKey());

        $this->assertEquals('0001:00000003:0001', $transaction->getId());
        $this->assertEquals('change_node_key', $transaction->getType());
        $this->assertEquals(1, $transaction->getNode());
        $this->assertEquals(0, $transaction->getUser());
        $this->assertEquals(1, $transaction->getMsgId());
        $this->assertEquals('0001-00000000-9B6F', $transaction->getSenderAddress());
        $date = new DateTime();
        $date->setTimestamp(1531495004);
        $this->assertEquals($date, $transaction->getTime());
        $this->assertNull($transaction->getTargetAddress());
        $this->assertEquals(0, $transaction->getTargetNode());
        $this->assertEquals('0000', $transaction->getTargetNodeId());
        $this->assertEquals(
            '73A5C92FA5142599B1C9863B43E026AFEFA6B57AEE8D189241C7F50C90BA5122',
            $transaction->getOldPublicKey()
        );
        $this->assertEquals(
            'EAE1C8793B5597C4B3F490E76AC31172C439690F8EE14142BB851A61F9A49F0E',
            $transaction->getNewPublicKey()
        );
        $this->assertEquals(
            '005451A44896768C5F39713DA0622EF721682E14497E3E0220672D6C489B02FF'
            . 'B177FB13DF74BD870107EBFBAE9F6BA155AD4B57F4372463F97120EE35CD2007',
            $transaction->getSignature()
        );
        $this->assertEquals(145, $transaction->getSize());
    }

    /**
     * @return string[]
     */
    private function getRawAccountCreated(): array
    {
        return json_decode(
            '{
			"id": "0002:0000000A:0001",
			"type": "account_created",
			"node": "2",
			"user": "2",
			"msg_id": "0",
			"time": "1531493862",
			"target_node": "1",
			"target_user": "0",
			"public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
			"size": "53"
		}',
            true
        );
    }

    /**
     * @return string[]
     */
    private function getRawChangeAccountKey(): array
    {
        return json_decode(
            '{
			"id": "0001:00000009:0001",
			"type": "change_account_key",
			"node": "1",
			"user": "0",
			"msg_id": "5",
			"time": "1531498103",
			"public_key": "EAE1C8793B5597C4B3F490E76AC31172C439690F8EE14142BB851A61F9A49F0E",
			"public_key_signature": "01411FAC10DE65000000008100000000000000B04EEF0100000000B04EEF0100'
            . '000000200000000000000020000000000000000000000000000000626C6F636B",
			"signature": "65870B267C50ABE43A63FE7294768C400DB050D455BCEC3E44C64B07F0F18392'
            . '348E7614A088DCC21327BC0A0F009A6A12CCFC070297E8E035C2DA9DA9449303",
			"size": "111"
		}',
            true
        );
    }

    /**
     * @return string[]
     */
    private function getRawChangeNodeKey(): array
    {
        return json_decode(
            '{
			"id": "0001:00000003:0001",
			"type": "change_node_key",
			"node": "1",
			"user": "0",
			"msg_id": "1",
			"time": "1531495004",
			"target_node": "0",
			"old_public_key": "73A5C92FA5142599B1C9863B43E026AFEFA6B57AEE8D189241C7F50C90BA5122",
			"new_public_key": "EAE1C8793B5597C4B3F490E76AC31172C439690F8EE14142BB851A61F9A49F0E",
			"signature": "005451A44896768C5F39713DA0622EF721682E14497E3E0220672D6C489B02FF'
            . 'B177FB13DF74BD870107EBFBAE9F6BA155AD4B57F4372463F97120EE35CD2007",
			"size": "145"
		}',
            true
        );
    }
}
