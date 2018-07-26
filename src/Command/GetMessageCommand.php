<?php

namespace Adshares\Ads\Command;

class GetMessageCommand extends AbstractCommand
{
    /**
     * @var null|string
     */
    private $blockId;

    /**
     * @var string
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
     * Returns command name.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'get_message';
    }

    /**
     * Returns command specific attributes.
     *
     * @return array
     */
    public function getAttributes(): array
    {
        $attributes = [];
        $attributes['message_id'] = $this->messageId;
        if ($this->blockId) {
            $attributes['block'] = $this->blockId;
        }
        return $attributes;
    }
}
