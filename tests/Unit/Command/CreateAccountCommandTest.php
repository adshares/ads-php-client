<?php

/**
 * Copyright (c) 2018-2021 Adshares sp. z o.o.
 *
 * This file is part of ADS PHP Client
 *
 * ADS PHP Client is free software: you can redistribute and/or modify it
 * under the terms of the GNU General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ADS PHP Client is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ADS PHP Client. If not, see <https://www.gnu.org/licenses/>
 */

namespace Adshares\Ads\Tests\Unit\Command;

use Adshares\Ads\Command\CreateAccountCommand;

class CreateAccountCommandTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateAccountCommand(): void
    {
        $command = new CreateAccountCommand();
        $this->assertEquals('create_account', $command->getName());
        $this->assertCount(0, $command->getAttributes());
    }

    public function testCreateAccountCommandWithKey(): void
    {
        $publicKey = 'D69BCCF69C2D0F6CED025A05FA7F3BA687D1603AC1C8D9752209AC2BBF2C4D17';
        $signature = '7A1CA8AF3246222C2E06D2ADE525A693FD81A2683B8A8788C32B7763DF6037A5'
            . 'DF3105B92FEF398AF1CDE0B92F18FE68DEF301E4BF7DB0ABC0AEA6BE24969006';
        $command = new CreateAccountCommand();
        $command->setAccountKey($publicKey, $signature);
        $this->assertEquals('create_account', $command->getName());
        $attributes = $command->getAttributes();
        $this->assertCount(2, $attributes);
        $this->assertArrayHasKey('public_key', $attributes);
        $this->assertEquals($publicKey, $attributes['public_key']);
        $this->assertArrayHasKey('confirm', $attributes);
        $this->assertEquals($signature, $attributes['confirm']);
    }
}
