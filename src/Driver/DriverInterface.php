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

namespace Adshares\Ads\Driver;

use Adshares\Ads\Command\CommandInterface;
use Adshares\Ads\Command\TransactionInterface;
use Adshares\Ads\Exception\CommandException;
use Adshares\Ads\Response\ResponseInterface;

interface DriverInterface
{
    /**
     * @param  CommandInterface $command
     * @return ResponseInterface
     * @throws CommandException
     */
    public function executeCommand(CommandInterface $command): ResponseInterface;

    /**
     * @param  TransactionInterface $transaction
     * @param  bool                 $isDryRun    if true, transaction will not be send to network
     * @return ResponseInterface
     */
    public function executeTransaction(TransactionInterface $transaction, bool $isDryRun = false): ResponseInterface;
}
