<?php

namespace Adshares\Ads\Command;

class GetPackageCommand extends AbstractCommand
{
    /**
     *
     * @var null|string $block
     */
    private $block;
    /**
     *
     * @var string $node
     */
    private $node;
    /**
     *
     * @var int $nodeMsid
     */
    private $nodeMsid;

    /**
     *
     * @param string $node
     * @param int $nodeMsid
     * @param null|string $block
     */
    public function __construct(string $node, int $nodeMsid, string $block = null)
    {
        $this->node = $node;
        $this->nodeMsid = $nodeMsid;
        $this->block = $block;
    }

    /**
     *
     * @return string
     */
    public function getName(): string
    {
        return 'get_message';
    }

    public function getAttributes(): array
    {
        $attributes = [];
        $attributes["node"] = $this->node;
        $attributes["node_msid"] = $this->nodeMsid;
        if ($this->block) {
            $attributes["block"] = $this->block;
        }
        return $attributes;
    }
}
