<?php


namespace Adshares\Ads\Tests\Unit\Driver;

use Adshares\Ads\Driver\CommandError;

class CommandErrorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Id of last defined error.
     */
    const ERROR_ID_MAX = 5057;

    public function testGetCode()
    {
        $errorDescription = 'Can\'t connect to server';
        $this->assertEquals(5028, CommandError::getCodeByMessage($errorDescription));
    }

    public function testGetCodeUnknown()
    {
        $this->assertEquals(5000, CommandError::getCodeByMessage('qwerty12345'));
    }

    public function testGetMessage()
    {
        $code = self::ERROR_ID_MAX;
        $this->assertEquals('No new blocks to download', CommandError::getMessageByCode($code));
    }

    public function testGetMessageUnknown()
    {
        $this->assertEquals('Unknown error.', CommandError::getMessageByCode(4999));
    }

    public function testRandomConversion()
    {
        for ($i = 1; $i <= 10; $i++) {
            $code = rand(5000, self::ERROR_ID_MAX);
            $this->assertEquals($code, CommandError::getCodeByMessage(CommandError::getMessageByCode($code)));
        }
    }
}
