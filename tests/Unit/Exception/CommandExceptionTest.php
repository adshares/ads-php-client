<?php


namespace Adshares\Ads\Tests\Unit\Exception;

use Adshares\Ads\Command\GetMeCommand;
use Adshares\Ads\Exception\CommandException;

class CommandExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testCommandException()
    {
        $command = new GetMeCommand();
        $e = new CommandException($command);
        $this->assertEquals($command, $e->getCommand());
    }
}
