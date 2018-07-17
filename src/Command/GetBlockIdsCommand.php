<?php

namespace Adshares\Ads\Command;

class GetBlockIdsCommand extends AbstractCommand
{
    /**
     *
     * @var null|string $from
     */
    private $from;
    /**
     *
     * @var null|string $from
     */
    private $to;

    /**
     * GetBlocksCommand constructor.
     *
     * @param null|string $from
     * @param null|string $to
     */
    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    /**
     *
     * @return string
     */
    public function getName(): string
    {
        return 'get_blocks';
    }

    public function getAttributes(): array
    {
        $attributes = [];
        if ($this->from) {
            $attributes["from"] = $this->from;
        }
        if ($this->to) {
            $attributes["to"] = $this->to;
        }
        return $attributes;
    }
}
