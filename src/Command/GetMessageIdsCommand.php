<?php

namespace Adshares\Ads\Command;

class GetMessageIdsCommand extends AbstractCommand
{
    /**
     *
     * @var null|string $blockId
     */
    private $blockId;

    /**
     *
     * @param null|string $blockId
     */
    public function __construct(?string $blockId)
    {
        $this->blockId = $blockId;
    }

    /**
     *
     * @return string
     */
    public function getName(): string
    {
        return 'get_message_list';
    }

    public function getAttributes(): array
    {
        if ($this->blockId) {
            return ["block" => $this->blockId];
        } else {
            return parent::getAttributes();
        }
    }
}
