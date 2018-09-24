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

namespace Adshares\Ads\Tests\Unit\Util;

use Adshares\Ads\Util\AdsValidator;

class AdsValidatorTest extends \PHPUnit\Framework\TestCase
{
    public function testAccountAddress()
    {
        $invalidEntries = [
            '0001:00000000',
            '0001:00000000:9B6F',
            '0001:00h00000:9B6F',
            '0001-000000AB-ZZZZ',
            '0001-00000003-AB0CDC',
        ];

        $validEntries = [
            '0001-00000000-9B6F',
            '0001-0000000f-6a80',
            '0001-000000AB-XXXX',
            '0001-00000003-AB0C',
        ];

        foreach ($invalidEntries as $entry) {
            $this->assertFalse(AdsValidator::isAccountAddressValid($entry), "Invalid address accepted: $entry");
        }
        foreach ($validEntries as $entry) {
            $this->assertTrue(AdsValidator::isAccountAddressValid($entry), "Valid address rejected: $entry");
        }
    }

    public function testMessageId()
    {
        $invalidEntries = [
            '0001-000000AB-XXXX',
            '0001-000000AB-ZZZZ',
            '0001:00000003:AB0C',
            '0001:00h00000',
        ];

        $validEntries = [
            '0001:000CD000',
            '0001:00009B6F',
            '0001:00000abc',
            '0001:00000003',
        ];

        foreach ($invalidEntries as $entry) {
            $this->assertFalse(AdsValidator::isMessageIdValid($entry), "Invalid message id accepted: $entry");
        }
        foreach ($validEntries as $entry) {
            $this->assertTrue(AdsValidator::isMessageIdValid($entry), "Valid message id rejected: $entry");
        }
    }

    public function testTransactionId()
    {
        $invalidEntries = [
            '0001:000CD000',
            '0001-000000AB-XXXX',
            '0001-000000AB-ZZZZ',
            '0001:00h00000:9B6F',
            '00001:00000003:AB0C',
        ];

        $validEntries = [
            '0001:00000000:9B6F',
            '0001:00000abc:9b6f',
            '0001:00000003:AB0C',
        ];

        foreach ($invalidEntries as $entry) {
            $this->assertFalse(AdsValidator::isTransactionIdValid($entry), "Invalid tx id accepted: $entry");
        }
        foreach ($validEntries as $entry) {
            $this->assertTrue(AdsValidator::isTransactionIdValid($entry), "Valid tx id rejected: $entry");
        }
    }
}
