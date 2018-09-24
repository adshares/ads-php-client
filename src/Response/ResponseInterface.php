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

use Adshares\Ads\Entity\Tx;

/**
 * Interface ResponseInterface
 *
 * @package Adshares\Ads\Response
 */
interface ResponseInterface
{

    /**
     * @return \DateTime Time of current block
     */
    public function getCurrentBlockTime(): \DateTime;

    /**
     * @return \DateTime Time of previous block
     */
    public function getPreviousBlockTime(): \DateTime;

    /**
     * @return Tx
     */
    public function getTx(): Tx;

    /**
     * @param  null|string $key key in data array
     * @return mixed data for given key, for null key all data is returned, if key is not present null is returned
     */
    public function getRawData(?string $key = null);
}
