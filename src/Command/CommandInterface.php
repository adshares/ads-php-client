<?php

namespace Adshares\Ads\Command;

interface CommandInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return array
     */
    public function getAttributes(): array;
}
