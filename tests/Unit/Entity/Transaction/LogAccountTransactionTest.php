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

use Adshares\Ads\Entity\Account;
use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Entity\Transaction\LogAccountTransaction;

class LogAccountTransactionTest extends \PHPUnit\Framework\TestCase
{
    public function testLogAccountFromRaw(): void
    {
        /* @var LogAccountTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawLogAccount());

        $this->assertEquals('0002:00000012:0001', $transaction->getId());
        $this->assertEquals('log_account', $transaction->getType());
        $this->assertEquals(2, $transaction->getNode());
        $this->assertEquals(1, $transaction->getUser());
        $this->assertEquals(1, $transaction->getMsgId());
        $date = new \DateTime();
        $date->setTimestamp(1531496426);
        $this->assertEquals($date, $transaction->getTime());
        $this->assertEquals(
            '8FCF056D26B03DFF50624933FE8CAE43C8C7160CBBCA5B4FD9EDBDEF445F39F3'
            . '13B57CB9EB1908E732186D9F1433F69E07FD1EF49D44596A08D7A34F560EF109',
            $transaction->getSignature()
        );
        $this->assertEquals(207, $transaction->getSize());

        /* @var Account $networkAccount */
        $account = $transaction->getNetworkAccount();

        $this->assertEquals('0002-00000001-659C', $account->getAddress());
        $this->assertEquals(2, $account->getNode());
        $this->assertEquals('0002', $account->getNodeId());
        $this->assertEquals(1, $account->getMsid());
        $date = new \DateTime();
        $date->setTimestamp(1531496192);
        $this->assertEquals($date, $account->getTime());
        $this->assertEquals(0, $account->getStatus());
        $this->assertNull($account->getPairedAddress());
        $this->assertEquals(2, $account->getPairedNode());
        $this->assertEquals('0002', $account->getPairedNodeId());
        $date->setTimestamp(1531496192);
        $this->assertEquals($date, $account->getLocalChange());
        $date->setTimestamp(1531496384);
        $this->assertEquals($date, $account->getRemoteChange());
        $this->assertEquals(69999999980000000, $account->getBalance());
        $this->assertEquals(
            'A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363',
            $account->getPublicKey()
        );
        $this->assertEquals('68E046D32C6959447B1284A9F51CFACE9CE587446F698039D93FFB1FF1927080', $account->getHash());
        $this->assertEquals(false, $account->isStatusDeleted());
    }

    private function getRawLogAccount(): array
    {
        return json_decode('{
			"id": "0002:00000012:0001",
			"type": "log_account",
			"node": "2",
			"user": "1",
			"msg_id": "1",
			"time": "1531496426",
			"signature": "8FCF056D26B03DFF50624933FE8CAE43C8C7160CBBCA5B4FD9EDBDEF445F39F3'
            . '13B57CB9EB1908E732186D9F1433F69E07FD1EF49D44596A08D7A34F560EF109",
			"network_account": {
				"address": "0002-00000001-659C",
				"node": "2",
				"id": "1",
				"msid": "1",
				"time": "1531496192",
				"date": "2018-07-13 17:36:32",
				"status": "0",
				"paired_node": "2",
				"paired_id": "1",
				"local_change": "1531496192",
				"remote_change": "1531496384",
				"balance": "699999.99980000000",
				"public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
				"hash": "68E046D32C6959447B1284A9F51CFACE9CE587446F698039D93FFB1FF1927080",
				"checksum": "true"
			},
			"size": "207"
		}', true);
    }
}
