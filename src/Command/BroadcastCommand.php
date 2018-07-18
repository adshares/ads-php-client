<?php

namespace Adshares\Ads\Command;

class BroadcastCommand extends AbstractTransactionCommand
{
    /**
     * @var string $message
     */
    private $message;

    /**
     * BroadcastCommand constructor.
     *
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     *
     * @return string
     */
    public function getName(): string
    {
        return 'broadcast';
    }

    public function getAttributes(): array
    {
        return ["message" => $this->message];
    }
}
