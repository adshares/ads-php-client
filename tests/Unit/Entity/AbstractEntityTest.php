<?php

namespace Adshares\Ads\Tests\Unit\Entity;

class AbstractEntityTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateFromRow(): void
    {
        $data = [
            'float_val' => 123.456,
            'date' => '2018-07-24 08:54:31',
        ];
        /* @var ExtendedEntity $entity */
        $entity = ExtendedEntity::createFromRawData($data);

        $this->assertInstanceOf(ExtendedEntity::class, $entity);
        if ($entity instanceof ExtendedEntity) {
            $this->assertNotNull($entity->floatVal);
            $this->assertNotNull($entity->date);
        }
    }
}
