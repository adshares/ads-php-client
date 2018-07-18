<?php

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Entity\Message;

class GetMessageResponse extends AbstractResponse
{
    /**
     * @var Message
     */
    protected $message;

    /**
     * @var array[AbstractTransaction]
     */
    protected $transactions = [];

    /**
     * @param array $data
     */
    protected function loadData(array $data): void
    {
        parent::loadData($data);

        $this->message = EntityFactory::createMessage($data);

        if (array_key_exists('transactions', $data)) {
            $blockId = $data['block_id'];
            $messageId = $data['message_id'];
            $nodeId = sprintf('%04X', $data['node']);
            foreach ($data['transactions'] as $value) {
                $value['block_id'] = $blockId;
                $value['message_id'] = $messageId;
                $value['node_id'] = $nodeId;
                $this->transactions[] = EntityFactory::createTransaction($value);
            }
        }
    }

    /**
     * @return Message
     */
    public function getMessage(): Message
    {
        return $this->message;
    }

    /**
     * @return array
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }
}