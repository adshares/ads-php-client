<?php

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\EntityFactory;

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
     * @var array[Broadcast]
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
     * @return array Array of broadcast messages
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
