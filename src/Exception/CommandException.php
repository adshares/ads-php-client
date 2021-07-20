<?php

/**
 * Copyright (c) 2018-2021 Adshares sp. z o.o.
 *
 * This file is part of ADS PHP Client
 *
 * ADS PHP Client is free software: you can redistribute and/or modify it
 * under the terms of the GNU General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ADS PHP Client is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ADS PHP Client. If not, see <https://www.gnu.org/licenses/>
 */

namespace Adshares\Ads\Exception;

use Adshares\Ads\Command\CommandInterface;
use Throwable;

/**
 * CommandException is exception during command call.
 *
 * @package Adshares\Ads\Exception
 */
class CommandException extends AdsException
{
    /**
     * @var CommandInterface
     */
    protected $command;

    /**
     * CommandException constructor.
     *
     * @param CommandInterface $command
     * @param string           $message  [optional] The Exception message to throw.
     * @param int              $code     [optional] The Exception code.
     * @param Throwable|null  $previous [optional] The previous throwable used for the exception chaining.
     */
    public function __construct(CommandInterface $command, $message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->command = $command;
    }

    /**
     * @return CommandInterface
     */
    public function getCommand(): CommandInterface
    {
        return $this->command;
    }
}
