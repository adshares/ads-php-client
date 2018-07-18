<?php

namespace Adshares\Ads\Command;

class GetBroadcastCommand extends AbstractCommand
{
    /**
     * @var null|string $blockId
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
     * @return string
     */
    public function getName(): string
    {
        return 'get_broadcast';
    }

    public function getAttributes(): array
    {
        if ($this->blockId) {
            return ["from" => $this->blockId];
        } else {
            return parent::getAttributes();
        }
    }
}
