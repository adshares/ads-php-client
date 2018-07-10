<?php

namespace Adshares\Ads\Command;

class GetBlockCommand extends AbstractCommand
{
    /**
     *
     * @var null|string $block
     */
    private $block;

    /**
     * GetBlocksCommand constructor.
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
        return 'get_block';
    }

    public function getAttributes(): array
    {
        $attributes = [];
        if ($this->block) {
            $attributes["block"] = $this->block;
        }
        return $attributes;
    }
}
