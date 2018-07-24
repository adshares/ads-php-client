<?php

namespace Adshares\Ads\Tests\Unit\Entity;

use Adshares\Ads\Entity\Account;

/**
 * Class ExtendedAccount is extended from Account to perform AdsClient.testSetEntityMap() test.
 *
 * @package Adshares\Ads\Tests\Unit\Entity
 */
class ExtendedAccount extends Account
{
    /**
     * @return string Account address
     */
    public function getId(): string
    {
        return $this->getAddress();
    }
}
