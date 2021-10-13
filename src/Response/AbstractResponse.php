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

use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Entity\Tx;
use DateTime;
use DateTimeInterface;

/**
 * Class AbstractResponse is base class for all response classes.
 *
 * @package Adshares\Ads\Response
 */
abstract class AbstractResponse implements ResponseInterface
{
    /**
     * ADS response data array
     *
     * @var string[]|string[][]|string[][][]|string[][][][]
     */
    protected $data = [];

    /**
     * Time of current block
     *
     * @var DateTimeInterface
     */
    protected $currentBlockTime;

    /**
     * Time of previous block
     *
     * @var DateTimeInterface
     */
    protected $previousBlockTime;

    /**
     *
     *
     * @var Tx
     */
    protected $tx;

    /**
     * AbstractResponse constructor.
     *
     * @param string[]|string[][]|string[][][]|string[][][][] $data ADS response data
     */
    public function __construct(array $data)
    {
        $this->loadData($data);
    }

    public function getCurrentBlockTime(): DateTimeInterface
    {
        return $this->currentBlockTime;
    }

    public function getPreviousBlockTime(): DateTimeInterface
    {
        return $this->previousBlockTime;
    }

    public function getTx(): Tx
    {
        return $this->tx;
    }

    /**
     * @param string[]|string[][]|string[][][]|string[][][][] $data ADS response data array
     */
    protected function loadData(array $data): void
    {
        $this->data = $data;

        if (array_key_exists('current_block_time', $data)) {
            $date = new DateTime();
            $date->setTimestamp((int)$data['current_block_time']);

            $this->currentBlockTime = $date;
        }

        if (array_key_exists('previous_block_time', $data)) {
            $date = new DateTime();
            $date->setTimestamp((int)$data['previous_block_time']);

            $this->previousBlockTime = $date;
        }

        if (array_key_exists('tx', $data) && is_array($data['tx'])) {
            $this->tx = EntityFactory::createTx($data['tx']);
        }
    }

    public function getRawData(?string $key = null)
    {
        if (null === $key) {
            return $this->data;
        }

        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }

        return null;
    }
}
