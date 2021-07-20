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

use DateTime;
use PHPUnit\Framework\TestCase;

class AbstractEntityTest extends TestCase
{
    public function testCreateFromRow(): void
    {
        $data = [
            'float_val' => 123.456,
            'date' => '2018-07-24 08:54:31',
            'text_val' => 'value',
        ];
        /* @var ExtendedEntity $entity */
        $entity = ExtendedEntity::createFromRawData($data);

        $this->assertInstanceOf(ExtendedEntity::class, $entity);
        if ($entity instanceof ExtendedEntity) {
            $this->assertNotNull($entity->floatVal);
            $this->assertEquals(123.456, $entity->floatVal);
            $this->assertNotNull($entity->date);
            $this->assertEquals(new DateTime('2018-07-24 08:54:31'), $entity->date);
            $this->assertNotNull($entity->textVal);
            $this->assertEquals('value', $entity->textVal);
        }
    }
    public function testInvalidDate(): void
    {
        $data = [
            'float_val' => 123.456,
            'date' => 'foo date',
        ];
        /* @var ExtendedEntity $entity */
        $entity = ExtendedEntity::createFromRawData($data);

        $this->assertInstanceOf(ExtendedEntity::class, $entity);
        if ($entity instanceof ExtendedEntity) {
            $this->assertNull($entity->date);
        }
    }
}
