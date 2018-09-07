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

class BroadcastCommand extends AbstractTransactionCommand
{
    /**
     * Hexadecimal string with even number of characters (each two characters represents one byte). Maximum size of
     * message is 32000 bytes.
     *
     * @var string
     */
    private $message;

    /**
     * BroadcastCommand constructor.
     *
     * @param string $message Hexadecimal string with even number of characters
     *      (each two characters represents one byte). Maximum size of message is 32000 bytes.
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Returns command name.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'broadcast';
    }

    /**
     * Returns command specific attributes.
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return ['message' => $this->message];
    }
}
