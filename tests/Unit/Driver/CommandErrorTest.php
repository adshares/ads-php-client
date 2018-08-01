<?php
/**
 * Copyright (C) 2018 Adshares sp. z. o.o.
 *
 * This file is part of ADS PHP Client
 *
 * ADS PHP Client is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ADS PHP Client is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ADS PHP Client.  If not, see <https://www.gnu.org/licenses/>.
 */

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
