<?php


namespace Adshares\Ads\Tests\Unit\Util;

use Adshares\Ads\Util\AdsConverter;

class AdsConverterTest extends \PHPUnit\Framework\TestCase
{
    public function testToClicks()
    {
        $entries = [
            [123.456, 12345600000000],
            ["123.45", 12345000000000],
            [456, 45600000000000],
        ];
        foreach ($entries as $entry) {
            $this->assertEquals($entry[1], AdsConverter::adsToClicks($entry[0]));
        }
    }

    public function testToAds()
    {
        $entries = [
            [12345678901, "0.12345678901"],
            [999, "0.00000000999"],
            [543543543543, "5.43543543543"],
        ];
        foreach ($entries as $entry) {
            $this->assertEquals($entry[1], AdsConverter::clicksToAds($entry[0]));
        }
    }
}
