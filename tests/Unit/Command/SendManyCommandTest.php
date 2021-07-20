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

use Adshares\Ads\Command\SendManyCommand;
use Adshares\Ads\Util\AdsConverter;
use PHPUnit\Framework\TestCase;

class SendManyCommandTest extends TestCase
{
    public function testSendManyCommand(): void
    {
        $wiresIn = [
            '0001-00000000-XXXX' => 100,
            '0001-00000001-XXXX' => 1,
        ];
        $command = new SendManyCommand($wiresIn);
        $this->assertEquals('send_many', $command->getName());
        /** @var string[] $wiresOut */
        $wiresOut = $command->getAttributes()['wires'];
        foreach ($wiresOut as $key => $value) {
            $wiresOut[$key] = AdsConverter::adsToClicks($value);
        }
        $this->assertEquals($wiresIn, $wiresOut);
    }
}
