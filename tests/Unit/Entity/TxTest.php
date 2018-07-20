<?php

namespace Adshares\Ads\Tests\Unit\Entity;

use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Entity\Tx;

class TxTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateTxFromRawGetMe(): void
    {
        /* @var Tx $tx */
        $tx = EntityFactory::createTx($this->getRawGetMe());
        $this->assertEquals('100100010000000100010000009CB1515B', $tx->getData());
        $this->assertEquals(
            'EED77864A1B52D45DA375AEA428E7245FA51E3B8CDD809408534B9BB5438DABC'
            . '5A1362B6BB0EADE83FC5F5D8D0EBD3ACDEB8DB62AE7E2220D8D7BE2862C2DF0E',
            $tx->getSignature()
        );
        $time = new \DateTime();
        $time->setTimestamp(1532080540);
        $this->assertEquals($time, $tx->getTime());

        $this->assertNull($tx->getAccountMsid());
        $this->assertNull($tx->getAccountHashin());
        $this->assertNull($tx->getAccountHashout());
        $this->assertNull($tx->getDeduct());
        $this->assertNull($tx->getFee());
        $this->assertNull($tx->getNodeMsid());
        $this->assertNull($tx->getNodeMpos());
        $this->assertNull($tx->getId());
    }

    public function testCreateTxFromRawGetLog(): void
    {
        /* @var Tx $tx */
        $tx = EntityFactory::createTx($this->getRawGetLog());
        $this->assertEquals('1114000500000000000000', $tx->getData());
        $this->assertEquals(
            'A673D71F69D29A125BC1CBA7BFFCC832EAE93C649E5D3DAB5FBC455EDA5779D4'
            . 'F17184F83133FE030727C88D407F8CB11F0C0283E59FDF0EECA2EDD2F98CFE01',
            $tx->getSignature()
        );
        $time = new \DateTime();
        $time->setTimestamp(0);
        $this->assertEquals($time, $tx->getTime());
        $this->assertEquals(0, $tx->getAccountMsid());
        $this->assertEquals(
            'FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF',
            $tx->getAccountHashin()
        );
        $this->assertEquals(
            '60B9DB8A786FE8E0B5EFF44CE143DFA4A811F2B2282669AFE02DD774FFE164AA',
            $tx->getAccountHashout()
        );
        $this->assertEquals(0, $tx->getDeduct());
        $this->assertEquals(0, $tx->getFee());

        $this->assertNull($tx->getNodeMsid());
        $this->assertNull($tx->getNodeMpos());
        $this->assertNull($tx->getId());
    }

    public function testCreateTxFromRawCreateAccount(): void
    {
        /* @var Tx $tx */
        $tx = EntityFactory::createTx($this->getRawCreateAccount());
        $this->assertEquals('06010000000000070000000688515B02000000000000000000'
            . '00000000000000000000000000000000000000000000000000000000', $tx->getData());
        $this->assertEquals(
            '9B9529F30015894D9660A251A219BD5776E6EFFA557BC00D2297BBDFB96AF8CDC'
            . '49BCBA9894DC296DE13E8F4D8FB94088061E6293BA9AAC955AAA395B5252605',
            $tx->getSignature()
        );
        $time = new \DateTime();
        $time->setTimestamp(1532069894);
        $this->assertEquals($time, $tx->getTime());
        $this->assertEquals(7, $tx->getAccountMsid());
        $this->assertEquals(
            '4FAA7D8BA7FB2DD86E9C307752CCC3F0691C29A0AE9552C045C3E31F9191C759',
            $tx->getAccountHashin()
        );
        $this->assertEquals(
            'A4B304F4FCAEB832F69DC274E7C040C3F604E44FC05FC6A6B7B1F5DA83786987',
            $tx->getAccountHashout()
        );
        $this->assertEquals(220000000, $tx->getDeduct());
        $this->assertEquals(200000000, $tx->getFee());
        $this->assertEquals(19, $tx->getNodeMsid());
        $this->assertEquals(1, $tx->getNodeMpos());
        $this->assertEquals('0001:00000013:0001', $tx->getId());
    }

    private function getRawGetMe(): array
    {
        return json_decode('{
            "data": "100100010000000100010000009CB1515B",
            "signature": "EED77864A1B52D45DA375AEA428E7245FA51E3B8CDD809408534B9BB5438DABC'
            . '5A1362B6BB0EADE83FC5F5D8D0EBD3ACDEB8DB62AE7E2220D8D7BE2862C2DF0E",
            "time": "1532080540"
        }', true);
    }

    private function getRawGetLog(): array
    {
        return json_decode('{
            "data": "1114000500000000000000",
            "signature": "A673D71F69D29A125BC1CBA7BFFCC832EAE93C649E5D3DAB5FBC455EDA5779D4'
            . 'F17184F83133FE030727C88D407F8CB11F0C0283E59FDF0EECA2EDD2F98CFE01",
            "time": "0",
            "account_msid": "0",
            "account_hashin": "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF",
            "account_hashout": "60B9DB8A786FE8E0B5EFF44CE143DFA4A811F2B2282669AFE02DD774FFE164AA",
            "deduct": "0.00000000000",
            "fee": "0.00000000000"
        }', true);
    }

    private function getRawCreateAccount(): array
    {
        return json_decode('{
            "data": "06010000000000070000000688515B02000000000000000000'
            . '00000000000000000000000000000000000000000000000000000000",
            "signature": "9B9529F30015894D9660A251A219BD5776E6EFFA557BC00D2297BBDFB96AF8CDC'
            . '49BCBA9894DC296DE13E8F4D8FB94088061E6293BA9AAC955AAA395B5252605",
            "time": "1532069894",
            "account_msid": "7",
            "account_hashin": "4FAA7D8BA7FB2DD86E9C307752CCC3F0691C29A0AE9552C045C3E31F9191C759",
            "account_hashout": "A4B304F4FCAEB832F69DC274E7C040C3F604E44FC05FC6A6B7B1F5DA83786987",
            "deduct": "0.00220000000",
            "fee": "0.00200000000",
            "node_msid": "19",
            "node_mpos": "1",
            "id": "0001:00000013:0001"
        }', true);
    }
}
