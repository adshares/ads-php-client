<?php

namespace Adshares\Ads\Command;

class GetBroadcastCommand extends AbstractCommand
{
    /**
     * @var null|string
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
     * Returns command name.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'get_broadcast';
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
            $attributes['from'] = $this->blockId;
        }
        return $attributes;
    }
}
