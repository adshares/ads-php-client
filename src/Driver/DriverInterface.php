<?php

namespace Adshares\Ads\Driver;

use Adshares\Ads\Command\CommandInterface;
use Adshares\Ads\Response\ResponseInterface;

interface DriverInterface
{
    public function executeCommand(CommandInterface $command): ResponseInterface;
}
