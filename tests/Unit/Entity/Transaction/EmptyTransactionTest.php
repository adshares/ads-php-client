<?php

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
