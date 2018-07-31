<?php
/**
 * Copyright (C) 2018 Adshares sp. z. o.o.
 *
 * This file is part of PHP ADS Client
 *
 * PHP ADS Client is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * PHP ADS Client is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with PHP ADS Client.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\Broadcast;
use Adshares\Ads\Entity\EntityFactory;

/**
 * Response for GetBroadcast request.
 *
 * @package Adshares\Ads\Response
 */
class GetBroadcastResponse extends AbstractResponse
{
    /**
     * Field containing block id
     */
    const BLOCK_TIME_HEX = 'block_time_hex';

    /**
     * Field containing broadcast messages
     */
    const BROADCAST = 'broadcast';

    /**
     * Field containing number of broadcast messages
     */
    const BROADCAST_COUNT = 'broadcast_count';

    /**
     * Field containing type of log file
     */
    const LOG_FILE = 'log_file';

    /**
     * Block id
     *
     * @var string
     */
    protected $blockId;

    /**
     * Array of broadcast messages
     *
     * @var Broadcast[]
     */
    protected $broadcast = [];

    /**
     * Number of broadcast messages
     *
     * @var int
     */
    protected $broadcastCount;

    /**
     * Log file type. Two values are possible:
     * - archive: reporting previously reported broadcast log,
     * - new: reporting new broadcast log.
     *
     * @var string
     */
    protected $logFile;

    /**
     *
     * @param array $data
     */
    protected function loadData(array $data): void
    {
        parent::loadData($data);

        if (array_key_exists(self::BLOCK_TIME_HEX, $data)) {
            $this->blockId = $data[self::BLOCK_TIME_HEX];
        }
        if (array_key_exists(self::BROADCAST, $data)) {
            foreach ($data[self::BROADCAST] as $value) {
                $this->broadcast[] = EntityFactory::createBroadcast($value);
            }
        }
        if (array_key_exists(self::BROADCAST_COUNT, $data)) {
            $this->broadcastCount = $data[self::BROADCAST_COUNT];
        }
        if (array_key_exists(self::LOG_FILE, $data)) {
            $this->logFile = $data[self::LOG_FILE];
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
     * @return Broadcast[] Array of broadcast messages
     */
    public function getBroadcast(): array
    {
        return $this->broadcast;
    }

    /**
     * @return int Number of broadcast messages
     */
    public function getBroadcastCount(): int
    {
        return $this->broadcastCount;
    }

    /**
     * @return string Log file type. Two values are possible:
     *      'archive' - reporting previously reported broadcast log,
     *      'new' - reporting new broadcast log.
     */
    public function getLogFile(): string
    {
        return $this->logFile;
    }
}
