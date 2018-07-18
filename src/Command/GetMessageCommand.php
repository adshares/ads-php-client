<?php

namespace Adshares\Ads\Command;

class GetMessageCommand extends AbstractCommand
{
    /**
     * @var null|string $blockId
     */
    private $blockId;

    /**
     * @var string $messageId
     */
    private $messageId;

    /**
     * @param string $messageId
     * @param null|string $blockId
     */
    public function __construct(string $messageId, string $blockId = null)
    {
        $this->messageId = $messageId;
        $this->blockId = $blockId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'get_message';
    }

    public function getAttributes(): array
    {
        $attributes = [];
        $attributes["message_id"] = $this->messageId;
        if ($this->blockId) {
            $attributes["block"] = $this->blockId;
        }
        return $attributes;
    }
}
