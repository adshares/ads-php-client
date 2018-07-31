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
use Adshares\Ads\Entity\Transaction\EmptyTransaction;

class EmptyTransactionTest extends \PHPUnit\Framework\TestCase
{
    public function testEmptyFromRaw(): void
    {
        /* @var EmptyTransaction $transaction */
        $transaction = EntityFactory::createTransaction($this->getRawEmpty());

        $this->assertEquals('0002:00000026:0001', $transaction->getId());
        $this->assertEquals('empty', $transaction->getType());
        $this->assertEquals(10, $transaction->getSize());
    }

    private function getRawEmpty(): array
    {
        return json_decode('{
			"id": "0002:00000026:0001",
			"type": "empty",
			"size": "10"
		}', true);
    }
}
