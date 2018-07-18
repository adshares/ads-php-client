<?php

namespace Adshares\Ads\Command;

class GetBlockCommand extends AbstractCommand
{
    /**
     *
     * @var null|string $blockId
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
     * @return string
     */
    public function getName(): string
    {
        return 'get_block';
    }

    public function getAttributes(): array
    {
        $attributes = [];
        if ($this->blockId) {
            $attributes["block"] = $this->blockId;
        }
        return $attributes;
    }
}
