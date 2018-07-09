<?php

namespace Adshares\Ads\Exception;

use Adshares\Ads\Command\CommandInterface;

class CommandException extends AdsException
{
    /**
     * @var CommandInterface
     */
    protected $command;

    /**
     * CommandException constructor.
     * @param CommandInterface $command
     * @param string $message [optional] The Exception message to throw.
     * @param int $code [optional] The Exception code.
     * @param \Throwable|null $previous [optional] The previous throwable used for the exception chaining.
     */
    public function __construct(CommandInterface $command, $message = '', $code = 0, \Throwable $previous = null)
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
