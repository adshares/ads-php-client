<?php

namespace Adshares\Ads\Command;

class BroadcastCommand extends AbstractTransactionCommand
{
    /**
     * Hexadecimal string with even number of characters (each two characters represents one byte). Maximum size of
     * message is 32000 bytes.
     *
     * @var string
     */
    private $message;

    /**
     * BroadcastCommand constructor.
     *
     * @param string $message Hexadecimal string with even number of characters
     *      (each two characters represents one byte). Maximum size of message is 32000 bytes.
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Returns command name.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'broadcast';
    }

    /**
     * Returns command specific attributes.
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return ['message' => $this->message];
    }
}
