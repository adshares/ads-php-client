<?php

namespace Adshares\Ads\Response;

/**
 * Response for GetMessageIds.
 *
 * @package Adshares\Ads\Response
 */
class GetMessageIdsResponse extends AbstractResponse
{
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
     * Array of message ids
     *
     * @var array[string]
     */
    protected $messageIds = [];

    /**
     * @param array $data
     */
    protected function loadData(array $data): void
    {
        parent::loadData($data);

        if (array_key_exists('block_time_hex', $data)) {
            $this->blockId = $data['block_time_hex'];
        }
        if (array_key_exists('message_count', $data)) {
            $this->messageCount = $data['message_count'];
        }
        if (array_key_exists('messages', $data) && is_array($data['messages'])) {
            foreach ($data['messages'] as $value) {
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
     * @return array Array of message ids
     */
    public function getMessageIds(): array
    {
        return $this->messageIds;
    }
}
