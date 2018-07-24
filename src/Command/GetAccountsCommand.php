<?php

namespace Adshares\Ads\Command;

class GetAccountsCommand extends AbstractCommand
{
    /**
     * @var null|string $blockId
     */
    private $blockId;

    /**
     * @var int $node
     */
    private $node;

    /**
     * @param int $node
     * @param null|string $blockId
     */
    public function __construct(int $node, ?string $blockId = null)
    {
        $this->blockId = $blockId;
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
        if ($this->blockId) {
            $attributes['block'] = $this->blockId;
        }
        $attributes['node'] = $this->node;
        return $attributes;
    }
}
