<?php

namespace Adshares\Ads\Command;

class GetBlockCommand extends AbstractCommand
{
    /**
     *
     * @var null|string
     */
    private $blockId;

    /**
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
        return 'get_block';
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
