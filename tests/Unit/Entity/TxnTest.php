<?php

namespace Adshares\Ads\Tests\Unit\Entity;

use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Entity\Txn;

class TxnTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateFromRow(): void
    {
        /* @var Txn $txn */
        $txn = EntityFactory::createTxn($this->getRawData());
        $this->assertEquals('send_one', $txn->getType());
        $this->assertEquals(2, $txn->getNode());
        $this->assertEquals(0, $txn->getUser());
        $this->assertEquals(1, $txn->getMsgId());
        $this->assertEquals(new \DateTime('@1530887371'), $txn->getTime());
        $this->assertEquals(1, $txn->getDestinationNode());
        $this->assertEquals(1, $txn->getDestinationUser());
        $this->assertEquals(100000000, $txn->getSenderFee());
        $this->assertEquals(1, $txn->getDestinationUser());
        $this->assertEquals('0002-00000000-75BD', $txn->getSenderAddress());
        $this->assertEquals('0001-00000001-8B4E', $txn->getTargetAddress());
        $this->assertEquals(100000000000, $txn->getAmount());
        $this->assertEquals('0000000000000000000000000000000000000000000000000000000000000000', $txn->getMessage());
        $this->assertEquals(
            'AF57C416A906E26443B6B87EC1D863EC46CD5F49855BA8485D39360CD7D2543A'
            . '040E855F780E5247A1F17C5E21B5F0DBC5940294751DF2465162A9FDD5ED820F',
            $txn->getSignature()
        );
    }

    private function getRawData(): array
    {
        return json_decode('{
            "type": "send_one",
            "node": "2",
            "user": "0",
            "msg_id": "1",
            "time": "1530887371",
            "destination_node": "1",
            "destination_user": "1",
            "sender_fee": "0.00100000000",
            "sender_address": "0002-00000000-75BD",
            "target_address": "0001-00000001-8B4E",
            "amount": "1.00000000000",
            "message": "0000000000000000000000000000000000000000000000000000000000000000",
            "signature": "AF57C416A906E26443B6B87EC1D863EC46CD5F49855BA8485D39360CD7D2543A'
                        .'040E855F780E5247A1F17C5E21B5F0DBC5940294751DF2465162A9FDD5ED820F"
        }', true);
    }
}
