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

use Adshares\Ads\Entity\Account;
use Adshares\Ads\Entity\EntityFactory;

/**
 * Response for GetAccounts request.
 *
 * @package Adshares\Ads\Response
 */
class GetAccountsResponse extends AbstractResponse
{
    /**
     * Array of accounts
     *
     * @var Account[]
     */
    protected $accounts;

    protected function loadData(array $data): void
    {
        parent::loadData($data);

        if (array_key_exists('accounts', $data) && is_array($data['accounts'])) {
            foreach ($data['accounts'] as $value) {
                if (is_array($value)) {
                    $this->accounts[] = EntityFactory::createAccount($value);
                }
            }
        }
    }

    /**
     * @return Account[] Array of accounts
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }
}
