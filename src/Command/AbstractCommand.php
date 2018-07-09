<?php

namespace Adshares\Ads\Command;

abstract class AbstractCommand implements CommandInterface
{

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return [];
    }
}
