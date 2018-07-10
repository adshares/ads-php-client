<?php

namespace Adshares\Ads\Command;

class GetAccountsCommand extends AbstractCommand
{
    /**
     *
     * @var null|string $block
     */
    private $block;
    /**
     *
     * @var int $node
     */
    private $node;

    /**
     * GetBlocksCommand constructor.
     *
     * @param int $node
     * @param null|string $block
     */
    public function __construct(int $node, string $block = null)
    {
        $this->block = $block;
        $this->node = $node;
    }

    /**
     *
     * @return string
     */
    public function getName(): string
    {
        return 'get_accounts';
    }

    public function getAttributes(): array
    {
        $attributes = [];
        if ($this->block) {
            $attributes["block"] = $this->block;
        }
        $attributes["node"] = $this->node;
        return $attributes;
    }
}
