<?php

namespace Adshares\Ads\Driver;

use Adshares\Ads\Command\CommandInterface;
use Adshares\Ads\Command\TransactionInterface;
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

    /**
     * @param TransactionInterface $transaction
     * @param bool $isDryRun if true, transaction will not be send to network
     * @return ResponseInterface
     */
    public function executeTransaction(TransactionInterface $transaction, bool $isDryRun = false): ResponseInterface;
}
