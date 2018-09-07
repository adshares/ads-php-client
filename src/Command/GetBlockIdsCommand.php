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

namespace Adshares\Ads\Command;

class GetBlockIdsCommand extends AbstractCommand
{
    /**
     *
     * @var null|string
     */
    private $blockIdFrom;
    /**
     *
     * @var null|string
     */
    private $blockIdTo;

    /**
     * @param null|string $blockIdFrom
     * @param null|string $blockIdTo
     */
    public function __construct(?string $blockIdFrom, ?string $blockIdTo)
    {
        $this->blockIdFrom = $blockIdFrom;
        $this->blockIdTo = $blockIdTo;
    }

    /**
     * Returns command name.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'get_blocks';
    }

    /**
     * Returns command specific attributes.
     *
     * @return array
     */
    public function getAttributes(): array
    {
        $attributes = [];
        if ($this->blockIdFrom) {
            $attributes['from'] = $this->blockIdFrom;
        }
        if ($this->blockIdTo) {
            $attributes['to'] = $this->blockIdTo;
        }
        return $attributes;
    }
}
