<?php

namespace Adshares\Ads\Entity;

interface EntityInterface
{
    /**
     * @param array $data
     * @return EntityInterface
     */
    public static function createFromRawData(array $data): EntityInterface;
}
