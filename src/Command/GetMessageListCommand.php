<?php

namespace Adshares\Ads\Command;

class GetMessageListCommand extends AbstractCommand
{
    /**
     *
     * @var null|string $from
     */
    private $from;

    /**
     * GetMessageListCommand constructor.
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
        return 'get_message_list';
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
