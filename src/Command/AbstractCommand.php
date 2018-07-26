<?php

namespace Adshares\Ads\Command;

/**
 * Class AbstractCommand
 *
 * @package Adshares\Ads\Command
 */
abstract class AbstractCommand implements CommandInterface
{
    /**
     * Returns command specific attributes.
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return [];
    }
}
