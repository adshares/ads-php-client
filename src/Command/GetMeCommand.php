<?php

namespace Adshares\Ads\Command;

class GetMeCommand extends AbstractCommand
{
    /**
     * Returns command name.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'get_me';
    }
}
