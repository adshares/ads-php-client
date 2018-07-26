<?php
/**  */

namespace Adshares\Ads\Command;

/**
 * CommandInterface is interface for all commands executed on ADS client. Every command has set of attributes. The
 * 'name' attribute is special, because it is present in every request.
 *
 * @package Adshares\Ads\Command
 */
interface CommandInterface
{
    /**
     * Returns command name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Returns command specific attributes.
     *
     * @return array
     */
    public function getAttributes(): array;
}
