<?php

namespace Adshares\Ads\Command;

class GetMessageCommand extends AbstractCommand
{
    /**
     * @var null|string $block
     */
    private $block;

    /**
     * @var string $messageId
     */
    private $messageId;

    /**
     * @param string $packageId
     * @param null|string $block
     */
    public function __construct($packageId, string $block = null)
    {
        $this->messageId = $packageId;
        $this->block = $block;
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
        if ($this->block) {
            $attributes["block"] = $this->block;
        }
        return $attributes;
    }
}
