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

use Adshares\Ads\Command\ChangeNodeKeyCommand;
use Adshares\Ads\Util\AdsValidator;
use PHPUnit\Framework\TestCase;

class ChangeNodeKeyTest extends TestCase
{
    /**
     * Public key generated from `a` pass-phrase
     *
     * @var string
     */
    private $publicKey = 'EAE1C8793B5597C4B3F490E76AC31172C439690F8EE14142BB851A61F9A49F0E';

    public function testChangeNodeKey(): void
    {
        $client = new TestAdsClient();
        /*
         * If `Matching secret key not found` exception is thrown,
         * Please check if matching secret_key
         * is added to key/key.txt file for node which key should be changed.
         *
         * The secret_key generated from `a` pass-phrase is
         * `CA978112CA1BBDCAFAC231B39A23DC4DA786EFF8147C4E72B9807785AFEE48BB`.
         */
        $command = new ChangeNodeKeyCommand($this->publicKey);

        $response = $client->changeNodeKey($command);
        $this->assertTrue($response->isKeyChanged());
        $txid = $response->getTx()->getId();
        $this->assertNotNull($txid);
        if (null != $txid) {
            $this->assertTrue(AdsValidator::isTransactionIdValid($txid), 'Invalid tx.id');
        }
    }
}
