<?php

namespace Adshares\Ads\Tests\Unit\Command;

use Adshares\Ads\Command\SendManyCommand;
use Adshares\Ads\Util\AdsConverter;

class SendManyCommandTest extends \PHPUnit\Framework\TestCase
{
    public function testSendManyCommand(): void
    {
        $wiresIn = [
            '0001-00000000-XXXX' => '100',
            '0001-00000001-XXXX' => '1',
        ];
        $command = new SendManyCommand($wiresIn);
        $this->assertEquals('send_many', $command->getName());
        $wiresOut = $command->getAttributes()['wires'];
        foreach ($wiresOut as $key => $value) {
            $wiresOut[$key] = AdsConverter::adsToClicks($value);
        }
        $this->assertEquals($wiresIn, $wiresOut);
    }
}
