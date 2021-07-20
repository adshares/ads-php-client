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

namespace Adshares\Ads\Entity\Transaction;

use Adshares\Ads\Entity\AbstractEntity;

/**
 * AbstractTransaction is base class for all transactions included in getMessage response.
 *
 * @package Adshares\Ads\Entity
 */
abstract class AbstractTransaction extends AbstractEntity
{
    /**
     * @var string
     */
    protected $blockId;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $messageId;

    /**
     * @var string
     */
    protected $nodeId;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var int
     */
    protected $size;

    /**
     * @return string
     */
    public function getBlockId(): string
    {
        return $this->blockId;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMessageId(): string
    {
        return $this->messageId;
    }

    /**
     * @return string
     */
    public function getNodeId(): string
    {
        return $this->nodeId;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }
}
