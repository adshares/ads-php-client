<?php

namespace Adshares\Ads\Tests\Unit\Command;

use Adshares\Ads\Command\BroadcastCommand;

class BroadcastCommandTest extends \PHPUnit\Framework\TestCase
{
    public function testBroadcastCommand(): void
    {
        $message = 'abcd';
        $command = new BroadcastCommand($message);
        $this->assertEquals('broadcast', $command->getName());
        $this->assertEquals($message, $command->getAttributes()['message']);
    }
}
