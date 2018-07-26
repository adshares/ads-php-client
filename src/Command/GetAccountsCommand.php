<?php

namespace Adshares\Ads\Command;

class GetAccountsCommand extends AbstractCommand
{
    /**
     * @var null|string
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
     * Returns command name.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'get_accounts';
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
        $attributes['node'] = $this->node;
        return $attributes;
    }
}
