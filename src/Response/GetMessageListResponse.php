<?php

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\Message;

class GetMessageListResponse extends AbstractResponse
{
    /**
     *
     * @var array[Message]
     */
    protected $messages = [];

    /**
     *
     * @param array $data
     */
    protected function loadData(array $data): void
    {
        parent::loadData($data);

        if (array_key_exists('messages', $data)) {
            foreach ($data['messages'] as $value) {
                $this->messages[] = Message::createFromRaw($value);
            }
        }
    }

    /**
     *
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }
}
