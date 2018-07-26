<?php

namespace Adshares\Ads\Command;

class GetBlockIdsCommand extends AbstractCommand
{
    /**
     *
     * @var null|string
     */
    private $blockIdFrom;
    /**
     *
     * @var null|string
     */
    private $blockIdTo;

    /**
     * @param null|string $blockIdFrom
     * @param null|string $blockIdTo
     */
    public function __construct(?string $blockIdFrom, ?string $blockIdTo)
    {
        $this->blockIdFrom = $blockIdFrom;
        $this->blockIdTo = $blockIdTo;
    }

    /**
     * Returns command name.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'get_blocks';
    }

    /**
     * Returns command specific attributes.
     *
     * @return array
     */
    public function getAttributes(): array
    {
        $attributes = [];
        if ($this->blockIdFrom) {
            $attributes['from'] = $this->blockIdFrom;
        }
        if ($this->blockIdTo) {
            $attributes['to'] = $this->blockIdTo;
        }
        return $attributes;
    }
}
