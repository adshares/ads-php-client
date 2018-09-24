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

/**
 * TransactionInterface is interface for transaction. Transaction is a command that is sent to blockchain network. It
 * must have defined hash of account and number of last message sent to network.
 *
 * @package Adshares\Ads\Command
 */
interface TransactionInterface extends CommandInterface
{
    /**
     * Returns hash of transaction sender account.
     *
     * @return null|string
     */
    public function getLastHash(): ?string;

    /**
     * Returns number of last sent message from transaction sender account.
     *
     * @return null|int
     */
    public function getLastMsid(): ?int;

    /**
     * Returns transaction sender address.
     *
     * @return null|string
     */
    public function getSender(): ?string;

    /**
     * Returns transaction signature.
     *
     * @return null|string
     */
    public function getSignature(): ?string;

    /**
     * Returns transaction timestamp.
     *
     * @return null|int
     */
    public function getTimestamp(): ?int;
}
