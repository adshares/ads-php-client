<?php
/**
 * Copyright (C) 2018 Adshares sp. z o.o.
 *
 * This file is part of ADS PHP Client
 *
 * ADS PHP Client is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ADS PHP Client is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ADS PHP Client.  If not, see <https://www.gnu.org/licenses/>
 */

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Entity\Message;
use Adshares\Ads\Entity\Transaction\AbstractTransaction;

/**
 * Response GetMessageResponse request.
 *
 * @package Adshares\Ads\Response
 */
class GetMessageResponse extends AbstractResponse
{
    /**
     * Message
     *
     * @var Message
     */
    protected $message;

    /**
     * Array of transactions
     *
     * @var AbstractTransaction[]
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
     * @return AbstractTransaction[] Array of transactions
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }
}
