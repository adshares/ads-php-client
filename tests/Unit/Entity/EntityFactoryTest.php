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

namespace Adshares\Ads\Tests\Unit\Entity;

use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Exception\AdsException;
use PHPUnit\Framework\TestCase;

class EntityFactoryTest extends TestCase
{
    public function testSetEntityMapException(): void
    {
        $entityMap = [
            'NonExistent' => 'Adshares\Ads\Tests\Unit\Entity\NonExistent',
        ];
        $this->expectException(AdsException::class);
        EntityFactory::setEntityMap($entityMap);
    }

    public function testCreateException(): void
    {
        $this->expectException(AdsException::class);
        EntityFactory::create('NonExistent');
    }

    public function testCreateTransactionException(): void
    {
        $this->expectException(AdsException::class);
        EntityFactory::createTransaction(['type' => 'NonExistent']);
    }
}
