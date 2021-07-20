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

namespace Adshares\Ads\Entity;

/**
 * Message from getMessage response.
 *
 * @package Adshares\Ads\Entity
 */
class Message extends AbstractEntity
{
    /**
     * Block id
     *
     * @var string
     */
    protected $blockId;

    /**
     * Message hash
     *
     * @var string
     */
    protected $hash;

    /**
     * Length
     *
     * @var int
     */
    protected $length;

    /**
     * Message id
     *
     * @var string
     */
    protected $id;

    /**
     * Node ordinal number
     *
     * @var int
     */
    protected $node;

    /**
     * @var \DateTime
     */
    protected $time;

    /**
     * @return string Block id
     */
    public function getBlockId(): string
    {
        return $this->blockId;
    }

    /**
     * @return string Message hash
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return int Length
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @return string Message id
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string Node id
     */
    public function getNodeId(): string
    {
        return sprintf('%04X', $this->node);
    }

    /**
     * @return \DateTime
     */
    public function getTime(): \DateTime
    {
        return $this->time;
    }

    /**
     * @param  array $data
     * @return EntityInterface
     */
    public static function createFromRawData(array $data): EntityInterface
    {
        $entity = new static();
        $entity->fillWithRawData($data);
        $entity->id = $data['message_id'];

        return $entity;
    }
}
