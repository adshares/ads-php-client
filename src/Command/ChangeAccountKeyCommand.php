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

namespace Adshares\Ads\Command;

class ChangeAccountKeyCommand extends AbstractTransactionCommand
{
    /**
     * Signature of empty string generated using secret key
     *
     * @var string
     */
    protected $confirm;

    /**
     * Public key
     *
     * @var string
     */
    protected $publicKey;

    /**
     * CreateAccountCommand constructor.
     *
     * @param string $publicKey Public key
     * @param string $confirm   Signature of empty string generated using secret key
     */
    public function __construct(string $publicKey, string $confirm)
    {
        $this->publicKey = $publicKey;
        $this->confirm = $confirm;
    }

    /**
     * Returns command name.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'change_account_key';
    }

    /**
     * Returns command specific attributes.
     *
     * @return array
     */
    public function getAttributes(): array
    {
        $attributes['confirm'] = $this->confirm;
        $attributes['public_key'] = $this->publicKey;
        return $attributes;
    }
}
