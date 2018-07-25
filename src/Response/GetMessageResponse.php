<?php

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Entity\Message;

class GetMessageResponse extends AbstractResponse
{
    /**
     * Message
     *
     * @var Message
     */
    protected $message;

    /**
     * Array of transactions Adshares\Ads\Entity\Transaction\AbstractTransaction
     *
     * @var array
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
     * @return Message Message
     */
    public function getMessage(): Message
    {
        return $this->message;
    }

    /**
     * @return array Array of transactions Adshares\Ads\Entity\Transaction\AbstractTransaction
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }
}
