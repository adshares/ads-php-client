<?php

namespace Adshares\Ads\Tests\Unit\Entity;

use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Exception\AdsException;

class EntityFactoryTest extends \PHPUnit\Framework\TestCase
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
