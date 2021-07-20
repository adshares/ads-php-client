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

namespace Adshares\Ads\Tests\E2E;

use Adshares\Ads\Command\CreateAccountCommand;
use PHPUnit\Framework\TestCase;

class CreateAccountTest extends TestCase
{
    /**
     * Public key generated from `a` pass-phrase
     *
     * @var string
     */
    private $publicKey = 'EAE1C8793B5597C4B3F490E76AC31172C439690F8EE14142BB851A61F9A49F0E';
    /**
     * Empty string signed with private key generated from `a` pass-phrase
     *
     * @var string
     */
    private $signature = '1F0571D30661FB1D50BE0D61A0A0E97BAEFF8C030CD0269ADE49438A4AD4CF897367'
    . 'E21B100C694F220D922200B3AB852A377D8857A64C36CB1569311760F303';

    public function testCreateAccount(): void
    {
        $client = new TestAdsClient();

        $command = new CreateAccountCommand();
        $response = $client->createAccount($command);

        $this->assertEquals($client->getAddress(), $response->getAccount()->getAddress());
        $newAccount = $response->getNewAccount();
        $this->assertEquals($newAccount->getNodeId(), substr($newAccount->getAddress(), 0, 4));
    }

    public function testCreateAccountWithChangeKey(): void
    {
        $client = new TestAdsClient();

        $command = new CreateAccountCommand();
        $command->setAccountKey($this->publicKey, $this->signature);
        $response = $client->createAccount($command);

        $this->assertEquals($client->getAddress(), $response->getAccount()->getAddress());
        $newAccount = $response->getNewAccount();
        $this->assertEquals($newAccount->getNodeId(), substr($newAccount->getAddress(), 0, 4));
    }
}
