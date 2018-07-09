<?php

namespace Adshares\Ads\Driver;

use Adshares\Ads\Command\CommandInterface;
use Adshares\Ads\Exception\CommandException;
use Adshares\Ads\Response\ResponseInterface;

interface DriverInterface
{
    /**
     * @param CommandInterface $command
     * @return ResponseInterface
     * @throws CommandException
     */
    public function executeCommand(CommandInterface $command): ResponseInterface;
}
