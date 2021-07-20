<?php

/**
 * Copyright (c) 2018-2021 Adshares sp. z o.o.
 *
 * This file is part of ADS PHP Client
 *
 * ADS PHP Client is free software: you can redistribute and/or modify it
 * under the terms of the GNU General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ADS PHP Client is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ADS PHP Client. If not, see <https://www.gnu.org/licenses/>
 */

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
    private const MESSAGES = 'messages';

    /**
     * Field containing number of messages
     */
    private const MESSAGE_COUNT = 'message_count';

    /**
     * Field containing block id
     */
    private const BLOCK_TIME_HEX = 'block_time_hex';

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
     * @var string[]
     */
    protected $messageIds = [];

    protected function loadData(array $data): void
    {
        parent::loadData($data);

        if (array_key_exists(self::BLOCK_TIME_HEX, $data) && !is_array($data[self::BLOCK_TIME_HEX])) {
            $this->blockId = $data[self::BLOCK_TIME_HEX];
        }
        if (array_key_exists(self::MESSAGE_COUNT, $data)) {
            $this->messageCount = (int)$data[self::MESSAGE_COUNT];
        }
        if (array_key_exists(self::MESSAGES, $data) && is_array($data[self::MESSAGES])) {
            foreach ($data[self::MESSAGES] as $value) {
                if (!is_array($value)) {
                    $this->messageIds[] = $value;
                }
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
     * @return string[] Array of message ids
     */
    public function getMessageIds(): array
    {
        return $this->messageIds;
    }
}
