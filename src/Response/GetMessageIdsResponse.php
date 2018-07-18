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

        if (array_key_exists('messages', $data)) {
            foreach ($data['messages'] as $value) {
                $this->messageIds[] = $value;
            }
        }
    }

    /**
     * @return array Array of message ids
     */
    public function getMessageIds(): array
    {
        return $this->messageIds;
    }
}
