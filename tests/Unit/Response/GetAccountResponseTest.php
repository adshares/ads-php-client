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

namespace Adshares\Ads\Tests\Unit\Response;

use Adshares\Ads\Entity\Account;
use Adshares\Ads\Entity\Tx;
use Adshares\Ads\Response\GetAccountResponse;

class GetAccountResponseTest extends \PHPUnit\Framework\TestCase
{
    public function testGetAccountFromRaw()
    {
        /* @var GetAccountResponse $response */
        $response = new GetAccountResponse($this->getRawData());
        $time = new \DateTime();
        $time->setTimestamp(1532091008);
        $this->assertEquals($time, $response->getCurrentBlockTime());
        $time->setTimestamp(1532090976);
        $this->assertEquals($time, $response->getPreviousBlockTime());

        $this->assertInstanceOf(Tx::class, $response->getTx());
        $this->assertInstanceOf(Account::class, $response->getAccount());
        $this->assertInstanceOf(Account::class, $response->getNetworkAccount());
    }

    private function getRawData(): array
    {
        return json_decode('{
            "current_block_time": "1532091008",
            "previous_block_time": "1532090976",
            "tx": {
                "data": "1001000000000002000000000097DA515B",
                "signature": "864344DCD64C5A8D48471DCB5FDDF8AC699CE9ED644B23E41D0FFEE3F0D6B6E12881A0EC'
            . '0A05A91EAD839151AB71062EABEA80A2B42BB13A9C346040674E5406",
                "time": "1532091031"
            },
            "account": {
                "address": "0002-00000000-75BD",
                "node": "2",
                "id": "0",
                "msid": "1",
                "time": "1532079936",
                "date": "2018-07-20 09:45:36",
                "status": "0",
                "paired_node": "2",
                "paired_id": "0",
                "local_change": "1532079936",
                "remote_change": "1532090976",
                "balance": "9999999.98963200198",
                "public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
                "hash": "081F0495069BF24ACE2813F53C668CDF4D1EEEFDB0BE6B4FB77498D8DD181936"
            },
            "network_account": {
                "address": "0002-00000000-75BD",
                "node": "2",
                "id": "0",
                "msid": "1",
                "time": "1532079936",
                "date": "2018-07-20 09:45:36",
                "status": "0",
                "paired_node": "2",
                "paired_id": "0",
                "local_change": "1532079936",
                "remote_change": "1532090976",
                "balance": "9999999.98963200198",
                "public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
                "hash": "081F0495069BF24ACE2813F53C668CDF4D1EEEFDB0BE6B4FB77498D8DD181936",
                "checksum": "true"
            }
        }', true);
    }
}
