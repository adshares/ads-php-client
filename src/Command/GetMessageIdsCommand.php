<?php

namespace Adshares\Ads\Command;

class GetMessageIdsCommand extends AbstractCommand
{
    /**
     *
     * @var null|string $block
     */
    private $block;

    /**
     *
     * @param null|string $block
     */
    public function __construct($block)
    {
        $this->block = $block;
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
        if ($this->block) {
            return ["block" => $this->block];
        } else {
            return parent::getAttributes();
        }
    }
}
