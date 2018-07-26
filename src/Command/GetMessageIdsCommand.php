<?php

namespace Adshares\Ads\Command;

class GetMessageIdsCommand extends AbstractCommand
{
    /**
     * @var null|string
     */
    private $blockId;

    /**
     *
     * @param null|string $blockId
     */
    public function __construct(?string $blockId)
    {
        $this->blockId = $blockId;
    }

    /**
     * Returns command name.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'get_message_list';
    }

    /**
     * Returns command specific attributes.
     *
     * @return array
     */
    public function getAttributes(): array
    {
        $attributes = [];
        if ($this->blockId) {
            $attributes['block'] = $this->blockId;
        }
        return $attributes;
    }
}
