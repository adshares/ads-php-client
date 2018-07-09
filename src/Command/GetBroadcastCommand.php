<?php

namespace Adshares\Ads\Command;

class GetBroadcastCommand extends AbstractCommand
{
    /**
     *
     * @var null|string $from
     */
    private $from;

    /**
     * GetBroadcastCommand constructor.
     *
     * @param null|string $from
     */
    public function __construct($from)
    {
        $this->from = $from;
    }

    /**
     *
     * @return string
     */
    public function getName(): string
    {
        return 'get_broadcast';
    }

    public function getAttributes(): array
    {
        if ($this->from) {
            return ["from" => $this->from];
        } else {
            return parent::getAttributes();
        }
    }
}
