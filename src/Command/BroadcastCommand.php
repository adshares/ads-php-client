<?php

namespace Adshares\Ads\Command;

class BroadcastCommand extends AbstractTransactionCommand
{
    /**
     * @var string $message hexadecimal string with even number of characters
     *      (each two characters represents one byte). Maximum size of message is 32000 bytes.
     */
    private $message;

    /**
     * BroadcastCommand constructor.
     *
     * @param string $message hexadecimal string with even number of characters
     *      (each two characters represents one byte). Maximum size of message is 32000 bytes.
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
