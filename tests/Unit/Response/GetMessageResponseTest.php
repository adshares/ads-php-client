<?php


namespace Adshares\Ads\Tests\Unit\Response;

use Adshares\Ads\Entity\Message;
use Adshares\Ads\Entity\Transaction\AbstractTransaction;
use Adshares\Ads\Entity\Tx;
use Adshares\Ads\Response\GetMessageResponse;
use Adshares\Ads\Tests\Unit\Raw;

class GetMessageResponseTest extends \PHPUnit\Framework\TestCase
{
    public function testGetMessageIdsFromRaw()
    {
        $response = new GetMessageResponse($this->getRawData());
        $time = new \DateTime();
        $time->setTimestamp(1532012352);
        $this->assertEquals($time, $response->getCurrentBlockTime());
        $time->setTimestamp(1532012320);
        $this->assertEquals($time, $response->getPreviousBlockTime());

        $this->assertInstanceOf(Tx::class, $response->getTx());
        $this->assertInstanceOf(Message::class, $response->getMessage());
        $transactions = $response->getTransactions();
        $this->assertCount(2, $transactions);
        foreach ($transactions as $transaction) {
            $this->assertInstanceOf(AbstractTransaction::class, $transaction);
        }
    }

    private function getRawData(): array
    {
        return json_decode(Raw::getMessage(), true);
    }
}
