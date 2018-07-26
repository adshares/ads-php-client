<?php

namespace Adshares\Ads\Response;

/**
 * Response for GetMessageIds request.
 *
 * @package Adshares\Ads\Response
 */
class GetMessageIdsResponse extends AbstractResponse
{
    /**
     * Field containing array of message ids
     */
    const MESSAGES = 'messages';

    /**
     * Field containing number of messages
     */
    const MESSAGE_COUNT = 'message_count';

    /**
     * Field containing block id
     */
    const BLOCK_TIME_HEX = 'block_time_hex';

    /**
     * Block id
     *
     * @var string
     */
    protected $blockId;

    /**
     * Number of messages in block
     *
     * @var int
     */
    protected $messageCount;

    /**
     * Array of message ids (string)
     *
     * @var array
     */
    protected $messageIds = [];

    /**
     * @param array $data
     */
    protected function loadData(array $data): void
    {
        parent::loadData($data);

        if (array_key_exists(self::BLOCK_TIME_HEX, $data)) {
            $this->blockId = $data[self::BLOCK_TIME_HEX];
        }
        if (array_key_exists(self::MESSAGE_COUNT, $data)) {
            $this->messageCount = $data[self::MESSAGE_COUNT];
        }
        if (array_key_exists(self::MESSAGES, $data) && is_array($data[self::MESSAGES])) {
            foreach ($data[self::MESSAGES] as $value) {
                $this->messageIds[] = $value;
            }
        }
    }

    /**
     * @return string Block id
     */
    public function getBlockId(): string
    {
        return $this->blockId;
    }

    /**
     * @return int Number of messages in block
     */
    public function getMessageCount(): int
    {
        return $this->messageCount;
    }

    /**
     * @return array Array of message ids (string)
     */
    public function getMessageIds(): array
    {
        return $this->messageIds;
    }
}
