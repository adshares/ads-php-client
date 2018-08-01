<?php
/**
 * Copyright (C) 2018 Adshares sp. z. o.o.
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
 * along with ADS PHP Client.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\EntityFactory;
use Adshares\Ads\Entity\Tx;

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
     * @var array
     */
    protected $data = [];

    /**
     * Time of current block
     *
     * @var \DateTime
     */
    protected $currentBlockTime;

    /**
     * Time of previous block
     *
     * @var \DateTime
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
     * @param array $data ADS response data
     */
    public function __construct(array $data)
    {
        $this->loadData($data);
    }

    /**
     * @return \DateTime Time of current block
     */
    public function getCurrentBlockTime(): \DateTime
    {
        return $this->currentBlockTime;
    }

    /**
     * @return \DateTime Time of previous block
     */
    public function getPreviousBlockTime(): \DateTime
    {
        return $this->previousBlockTime;
    }

    /**
     * @return Tx
     */
    public function getTx(): Tx
    {
        return $this->tx;
    }

    /**
     * @param array $data ADS response data array
     */
    protected function loadData(array $data): void
    {
        $this->data = $data;

        if (array_key_exists('current_block_time', $data)) {
            $date = new \DateTime();
            $date->setTimestamp($data['current_block_time']);

            $this->currentBlockTime = $date;
        }

        if (array_key_exists('previous_block_time', $data)) {
            $date = new \DateTime();
            $date->setTimestamp($data['previous_block_time']);

            $this->previousBlockTime = $date;
        }

        if (array_key_exists('tx', $data)) {
            $this->tx = EntityFactory::createTx($data['tx']);
        }
    }

    /**
     * @param  null|string $key key in data array
     * @return mixed data for given key, for null key all data is returned, if key is not present null is returned
     */
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
