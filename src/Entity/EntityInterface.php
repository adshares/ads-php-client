<?php

namespace Adshares\Ads\Entity;

interface EntityInterface
{
    public static function createFromRaw(array $data): EntityInterface;
}
