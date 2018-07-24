<?php

namespace Adshares\Ads\Command;

class GetMessageIdsCommand extends AbstractCommand
{
    /**
     *
     * @var null|string $blockId
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
     *
     * @return string
     */
    public function getName(): string
    {
        return 'get_message_list';
    }

    public function getAttributes(): array
    {
        $attributes = [];
        if ($this->blockId) {
            $attributes['block'] = $this->blockId;
        }
        return $attributes;
    }
}
