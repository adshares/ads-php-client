<?php


namespace Adshares\Ads\Tests\Unit\Util;

use Adshares\Ads\Util\AdsNormalizer;

class AdsNormalizerTest extends \PHPUnit\Framework\TestCase
{
    public function testNormalizeAddressValid()
    {
        $address = '000100000000XXXX';
        $address = AdsNormalizer::normalizeAddress($address);
        $this->assertEquals('0001-00000000-XXXX', $address);
    }

    public function testNormalizeAddressInvalid()
    {
        $address = 'XXXXXXXX';
        $this->expectException(\RuntimeException::class);
        AdsNormalizer::normalizeAddress($address);
    }

    public function testNormalizeTxidValid()
    {
        $txid = '0001000000010001';
        $txid = AdsNormalizer::normalizeTxid($txid);
        $this->assertEquals('0001:00000001:0001', $txid);
    }

    public function testNormalizeTxidInvalid()
    {
        $address = '000100000000XXXX';
        $this->expectException(\RuntimeException::class);
        AdsNormalizer::normalizeTxid($address);
    }
}
