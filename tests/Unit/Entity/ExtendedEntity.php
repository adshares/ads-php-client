<?php

namespace Adshares\Ads\Tests\Unit\Entity;

use Adshares\Ads\Entity\AbstractEntity;

/**
 * Class ExtendedEntity is extended from AbstractEntity to perform  test.
 *
 * @package Adshares\Ads\Tests\Unit\Entity
 */
class ExtendedEntity extends AbstractEntity
{
    /**
     * @var float
     */
    public $floatVal;

    /**
     * @var \DateTime
     */
    public $date;
}
