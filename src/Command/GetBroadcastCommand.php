<?php

namespace Adshares\Ads\Command;

class GetBroadcastCommand extends AbstractCommand
{
    /**
     * @var null|string $blockId
     */
    private $blockId;

    /**
     * @param null|string $blockId
     */
    public function __construct($blockId)
    {
        $this->blockId = $blockId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'get_broadcast';
    }

    public function getAttributes(): array
    {
        $attributes = [];
        if ($this->blockId) {
            $attributes['from'] = $this->blockId;
        }
        return $attributes;
    }
}
