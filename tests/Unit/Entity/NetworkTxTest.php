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

namespace Adshares\Ads\Tests\Unit\Entity;

use Adshares\Ads\Entity\EntityFactory;
use DateTime;
use PHPUnit\Framework\TestCase;

class NetworkTxTest extends TestCase
{
    public function testCreateFromRow(): void
    {
        $netTx = EntityFactory::createNetworkTx($this->getRawData());

        $this->assertEquals('0001:0000000B:0001', $netTx->getId());
        $this->assertEquals('AABBCCDD', $netTx->getBlockId());
        $blockTime = new DateTime();
        $blockTime->setTimestamp(1531495616);
        $this->assertEquals($blockTime, $netTx->getBlockTime());
        $this->assertEquals('1', $netTx->getNode());
        $this->assertEquals('0001', $netTx->getNodeId());
        $this->assertEquals(11, $netTx->getNodeMsid());
        $this->assertEquals(1, $netTx->getNodeMpos());
        $this->assertEquals(85, $netTx->getSize());
        $this->assertEquals(7, $netTx->getHashpathSize());
        $this->assertEquals(
            '0801000000000002000000BBC4485B020001000000D5FE451B11A7C42A8E322F40315FA52482A0314A15C5183753019'
            . '946C404FFA088D6300E6D11B9F5B2E39C07D074CE763E3263331B0C80C6C2BF7373BA03EB0B',
            $netTx->getData()
        );

        $hashPath = $netTx->getHashpath();
        $this->assertCount(7, $hashPath);
        foreach ($hashPath as $hash) {
            $this->assertIsString($hash);
        }
    }

    /**
     * @return array<int|string, array<int|string, string>|string>
     */
    private function getRawData(): array
    {
        return json_decode(
            '{
        "id": "0001:0000000B:0001",
        "block_time": "1531495616",
        "block_id": "AABBCCDD",
        "node": "1",
        "node_msid": "11",
        "node_mpos": "1",
        "size": "85",
        "hashpath_size": "7",
        "data": "0801000000000002000000BBC4485B020001000000D5FE451B11A7C42A8E322F40315FA52482A0314A15C518'
            . '3753019946C404FFA088D6300E6D11B9F5B2E39C07D074CE763E3263331B0C80C6C2BF7373BA03EB0B",
        "hashpath": ["7FBCE77182E5FDD6E58A08D3951179C44EA16F73936DDDF86B598B32DEEDF438", '
            . '"E8A17D524DF8671BD57FB04A7BC0DF8B260C56BB7E4AD0577E679ECC24B2BCE7", '
            . '"A4E0E06374166C7D131F91AD2B2F7577494A813A21D03710ACE7DEC8B9CE7A89", '
            . '"A588957308D6BD131950929540E962747052C1BD4E0BAADEA89594E5E171BDC8", '
            . '"1381D4255F4051F37B65CD80D596BA84FBAAF2197816041F5EB5FD8F03F1C0BD", '
            . '"A528B0C2763B85A8F33081E6E01721858C63872EB6B45C648B5339FFF3A350A8", '
            . '"7AD28E9374EFD27AFF422CCE5BE7FDB0812C3AAFB69268BEEA7517A11F6C44D2"]
    }',
            true
        );
    }
}
