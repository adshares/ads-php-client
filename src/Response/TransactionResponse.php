<?php
/**
 * Copyright (C) 2018 Adshares sp. z. o.o.
 *
 * This file is part of PHP ADS Client
 *
 * PHP ADS Client is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * PHP ADS Client is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with PHP ADS Client.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace Adshares\Ads\Response;

use Adshares\Ads\Entity\Account;
use Adshares\Ads\Entity\EntityFactory;

/**
 * Common response for most of the transactions.
 *
 * @package Adshares\Ads\Response
 */
class TransactionResponse extends AbstractResponse
{
    /**
     * Account state before executing transaction
     *
     * @var Account
     */
    protected $account;

    /**
     * @param array $data
     */
    protected function loadData(array $data): void
    {
        parent::loadData($data);

        if (array_key_exists('account', $data)) {
            $this->account = EntityFactory::createAccount($data['account']);
        }
    }

    /**
     * @return Account Account state before executing transaction
     */
    public function getAccount(): Account
    {
        return $this->account;
    }
}
