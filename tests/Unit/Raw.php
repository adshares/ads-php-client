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

namespace Adshares\Ads\Tests\Unit;

class Raw
{
    public static function changeAccountKey(): string
    {
        return '{
            "current_block_time": "1536737856",
            "previous_block_time": "1536737824",
            "tx": {
                "data": "090100000000000800000052C2985BEAE1C8793B5597C4B3F490E76AC'
            . '31172C439690F8EE14142BB851A61F9A49F0E",
                "signature": "20B8F34EA2DE4472B78A3B7648A91AC6E2572F70F9A69B332E452B5413F6D24DBE47F3E'
            . '7B298A0574CE0E011493AE6DA8905B7FDEB78D690A449F66385C0010E",
                "time": "1536737874",
                "account_msid": "8",
                "account_hashin": "24BEBF3057AF4737D08038A35BF32401011487756A505E8CA6A297FD8938B722",
                "account_hashout": "92872A9291190C993C526B96D620F08DE4A8B4792BEFF035D9483DBB44D36EA9",
                "deduct": "0.00010000000",
                "fee": "0.00010000000",
                "node_msid": "78",
                "node_mpos": "1",
                "id": "0001:0000004E:0001"
            },
            "result": "PKEY changed"
        }';
    }

    public static function changeNodeKey(): string
    {
        return '{
            "current_block_time": "1536744768",
            "previous_block_time": "1536744736",
            "tx": {
                "data": "0A0100000000000500000059DD985B0000EAE1C8793B5597C'
            . '4B3F490E76AC31172C439690F8EE14142BB851A61F9A49F0E",
                "signature": "6841E3C967CC1E91BB887F1C0510CB44B6646783670D3CEE8EC4BD563B1DC1868582DF7085F9AB247DD2'
            . '36C2C2FEF5140080680AD1285C940900E2A407D1AD02",
                "time": "1536744793",
                "account_msid": "5",
                "account_hashin": "A248D98C61011E9EB80443CE34CDC7DC5621DB209905D567F18F7FFCD1E20725",
                "account_hashout": "A0E0EF9676AD51CAACFF1621BF28677B154F25A52B6B3CB60B2110F63F6F3D86",
                "deduct": "0.10000000000",
                "fee": "0.10000000000",
                "node_msid": "27",
                "node_mpos": "1",
                "id": "0001:0000001B:0001"
            },
            "result": "Node key changed",
            "account": {
                "address": "0001-00000000-9B6F",
                "node": "1",
                "id": "0",
                "msid": "6",
                "time": "1536744793",
                "date": "2018-09-12 09:33:13",
                "status": "0",
                "paired_node": "0",
                "paired_id": "0",
                "local_change": "1536744768",
                "remote_change": "1536744736",
                "balance": "19999999.65734114180",
                "public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
                "hash": "A0E0EF9676AD51CAACFF1621BF28677B154F25A52B6B3CB60B2110F63F6F3D86"
            }
        }';
    }

    public static function createAccount(): string
    {
        return '{
            "current_block_time": "1536668480",
            "previous_block_time": "1536668448",
            "tx": {
                "data": "060200000000000300000042B3975B020000000000A9C0D972D8AAB73805EC4A28291E05'
            . '2E3B5FAFE0ADC9D724917054E5E2690363",
                "signature": "3FEC4E367A87B615FFDE40CA992D4676E271970881E0C676E5C08E9D2C7F9A7B495'
            . 'D2A0A92BCAAAED5DCFE8D79A69F8BC01008BE6F832D3FC04D5192A13BB90F",
                "time": "1536668482",
                "account_msid": "3",
                "account_hashin": "CDE7C5D0D243D60500BDD32A8FC2A9EA7E9F7631B6CCFE77C26521A323087665",
                "account_hashout": "CE4622401C53A8CE0F9C22A7B590C288EDD50869C10381FA50CD8737BD7FD345",
                "deduct": "0.00120000000",
                "fee": "0.00100000000",
                "node_msid": "882",
                "node_mpos": "2",
                "id": "0002:00000372:0002"
            },
            "account": {
                "address": "0002-00000000-75BD",
                "node": "2",
                "id": "0",
                "msid": "4",
                "time": "1536668482",
                "date": "2018-09-11 14:21:22",
                "status": "0",
                "paired_node": "0",
                "paired_id": "0",
                "local_change": "1536668480",
                "remote_change": "1536668416",
                "balance": "9999999.98762190920",
                "public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
                "hash": "CE4622401C53A8CE0F9C22A7B590C288EDD50869C10381FA50CD8737BD7FD345"
            },
            "new_account": {
                "address": "0002-00000004-3539",
                "node": "2",
                "id": "4"
            }
        }';
    }

    public static function createNode(): string
    {
        return '{
            "current_block_time": "1536734240",
            "previous_block_time": "1536734208",
            "tx": {
                "data": "07010000000000030000003FB4985B",
                "signature": "0ACC5DF6B9079667AB48B0DD529CD6B8154CC190997060ADA6CCA8F7AB99CE63CAC51E8210EDDB6'
            . '41F8927566A3F0B4FAD2153BB61FAB9D16C2F40D3390E5108",
                "time": "1536734271",
                "account_msid": "3",
                "account_hashin": "35CABB3B28BA322AE62063024917293549FD6D42BF7ADCC933584F1585025D97",
                "account_hashout": "F88B31EEB3ABEC09D55EC5891DDF3D8A5326DBD6CDFDF687117C0A7581D7260C",
                "deduct": "1001.00000000000",
                "fee": "1000.00000000000",
                "node_msid": "21",
                "node_mpos": "1",
                "id": "0001:00000015:0001"
            },
            "account": {
                "address": "0001-00000000-9B6F",
                "node": "1",
                "id": "0",
                "msid": "4",
                "time": "1536734271",
                "date": "2018-09-12 06:37:51",
                "status": "0",
                "paired_node": "0",
                "paired_id": "0",
                "local_change": "1536734240",
                "remote_change": "1536734208",
                "balance": "19999999.99681894976",
                "public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
                "hash": "F88B31EEB3ABEC09D55EC5891DDF3D8A5326DBD6CDFDF687117C0A7581D7260C"
            }
        }';
    }

    public static function getAccount(): string
    {
        return '{
            "current_block_time": "1532415264",
            "previous_block_time": "1532415232",
            "tx": {
                "data": "1001000000000001000000000027CD565B",
                "signature": "BB196BECB8DD8E6759E7FDFC1A738307F1CE1A052066EE612ADCAC633BE759A685941544B0'
            . '9BF4EA28185DEB60ABEBB24A4C5170226834ACE5E978C45DD75609",
                "time": "1532415271"
            },
            "account": {
                "address": "0001-00000000-9B6F",
                "node": "1",
                "id": "0",
                "msid": "3",
                "time": "1532415270",
                "date": "2018-07-24 08:54:30",
                "status": "0",
                "paired_node": "1",
                "paired_id": "0",
                "local_change": "1532415264",
                "remote_change": "1532415232",
                "balance": "19999699.84935875759",
                "public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
                "hash": "8592795CE4EE7AAEEC7BA0EBCB4E5B83DF0151B009363FECB99EB39B62549343"
            },
            "network_account": {
                "address": "0001-00000000-9B6F",
                "node": "1",
                "id": "0",
                "msid": "2",
                "time": "1532415268",
                "date": "2018-07-24 08:54:28",
                "status": "0",
                "paired_node": "0",
                "paired_id": "0",
                "local_change": "1532415264",
                "remote_change": "1532415232",
                "balance": "19999899.94935875759",
                "public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
                "hash": "3A94A2410419BCE77E40206ADA6E6DFBD55117BC3D137EF4EF3AD9058BADEFF3",
                "checksum": "true"
            }
        }';
    }

    public static function getAccounts(): string
    {
        return '{
            "current_block_time": "1532422144",
            "previous_block_time": "1532422112",
            "tx": {
                "data": "180100000000000AE8565BE0E7565B0100",
                "signature": "3F7F802C52449775234D6FCA015D9AEB9E270F1D27BC1A091CCF9659FE52B7C81C8B99E04F46D53F9D8'
            . '5135F929F3498A7AEEBFEF87FAA3DA91D1E412F94EB06",
                "time": "1532422154",
                "account_msid": "0",
                "account_hashin": "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF",
                "account_hashout": "E6DE11BBE1A5E7E10E8D10C01C2B5F83DB6AF1C2D0A22A0B38F1F0B5EA034365",
                "deduct": "0.00000000000",
                "fee": "0.00000000000"
            },
            "accounts": [{
                    "address": "0001-00000000-9B6F",
                    "node": "1",
                    "id": "0",
                    "msid": "4",
                    "time": "1532415271",
                    "date": "2018-07-24 08:54:31",
                    "status": "0",
                    "paired_node": "0",
                    "paired_id": "0",
                    "local_change": "1532415264",
                    "remote_change": "1532422080",
                    "balance": "19999699.87509796942",
                    "public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
                    "hash": "04D526CB20CCE3003B8A2103C5401ABBCAA3F42D03C2392629B6CF923F66323B"
                }, {
                    "address": "0001-00000001-8B4E",
                    "node": "1",
                    "id": "1",
                    "msid": "1",
                    "time": "1532414432",
                    "date": "2018-07-24 08:40:32",
                    "status": "0",
                    "paired_node": "1",
                    "paired_id": "1",
                    "local_change": "1532414432",
                    "remote_change": "1532421984",
                    "balance": "50199.98821000000",
                    "public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
                    "hash": "4528E7563589895DE3F18F0A28C8EDC159C76EAFE9ACC876A107EBFD534E48D0"
                }, {
                    "address": "0001-00000002-BB2D",
                    "node": "1",
                    "id": "2",
                    "msid": "1",
                    "time": "1532414432",
                    "date": "2018-07-24 08:40:32",
                    "status": "0",
                    "paired_node": "1",
                    "paired_id": "2",
                    "local_change": "1532414432",
                    "remote_change": "1532421984",
                    "balance": "8305.98820000000",
                    "public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
                    "hash": "F3816C5C21B6E7C163894621D8B4FEA0C6053C4CE5F7A4B70516745987AAAF49"
                }
            ]
        }';
    }

    public static function getBlock(): string
    {
        return '{
            "current_block_time": "1532421440",
            "previous_block_time": "1532421408",
            "tx": {
                "data": "1701000000000020E5565B4DE5565B",
                "signature": "076872033889584BFB8FBB7C05FDD36604111DCABDF3BC46CC89337D08B0563D521767B'
            . '61B60467E39371F60A857815E38947D5F9DED98A412F037813FA5E60E",
                "time": "1532421453"
            },
            "block_time_hex": "5B56E520",
            "block_time": "1532421408",
            "block_prev": "5B56E500",
            "block_next": "5B56E540",
            "block": {
                "id": "5B56E520",
                "time": "1532421408",
                "message_count": "4",
                "oldhash": "EFAA216F39750FE47ABABA66AB9168C7DBB727F202C2B45A5C85516211BC5DDB",
                "minhash": "8E466BA9FC2DDDDFA6C70365E59414C00769C77178BF9744AFCDC0AFFFFEE41E",
                "msghash": "EEF5F90F44C2C2F8B7A8A274FF32CE71F3455BAB4EB6DD97FFB5EBF62B06D006",
                "nodhash": "A55EF15FA68BECCAAF9CCC11DFDD7DD27A42148B5A76BB003F199578C1DD4E90",
                "viphash": "2A4831F1459C42E2CCF5C4E202C3301F94C381B6FB253DFED21DD015180D9507",
                "nowhash": "FD214FC008CDEE51A921CFB133D8A9FF8B503107BEC73B736E0225F6073B033C",
                "vote_yes": "0",
                "vote_no": "0",
                "vote_total": "3",
                "node_count": "4",
                "dividend_balance": "0.00000000000",
                "dividend_pay": "false",
                "nodes": [{
                        "id": "0000",
                        "public_key": "0000000000000000000000000000000000000000000000000000000000000000",
                        "hash": "0000000000000000000000000000000000000000000000000000000000000000",
                        "message_hash": "5611343B65A0A3A08C59F6923DDC9CC4BB3B7DE0A12CE4107B503A39B250A280",
                        "msid": "0",
                        "mtim": "1532414432",
                        "balance": "0.00000000000",
                        "status": "0",
                        "account_count": "0",
                        "port": "0",
                        "ipv4": "0.0.0.0"
                    }, {
                        "id": "0001",
                        "public_key": "73A5C92FA5142599B1C9863B43E026AFEFA6B57AEE8D189241C7F50C90BA5122",
                        "hash": "6241B452CAA725F45057B8D45A2DF37FC994ADF669F5F7E37976A90BA33E1A2E",
                        "message_hash": "CF97D2EF6B9A67D39F0F96A934E81B9B9F9E1F3990F8D7246B355387EB0DB775",
                        "msid": "106",
                        "mtim": "1532421414",
                        "balance": "20058205.85390889333",
                        "status": "6",
                        "account_count": "3",
                        "port": "8001",
                        "ipv4": "172.16.222.101"
                    }, {
                        "id": "0002",
                        "public_key": "FC4CA38301AC2080ADA2BC08C4A94405E546B659BD2EB559C1520A55586336CD",
                        "hash": "EF89516D2998E1C3646A07A1BB77E5E8C1C97EF973C12FE2F59568738B44CF31",
                        "message_hash": "943029F6A0ED646174D971278409D998D6853AA5C779736851F575339BDD4B06",
                        "msid": "611",
                        "mtim": "1532421420",
                        "balance": "10699999.98252993070",
                        "status": "2",
                        "account_count": "2",
                        "port": "8002",
                        "ipv4": "172.16.222.101"
                    }, {
                        "id": "0003",
                        "public_key": "5138AA57FAF5F7F2E67BDCA14F3CC377CD4C681B3F8B5A41DDDD590BD36C3125",
                        "hash": "BB7BC80A87C4E5A30F8AD318B598D943765E4D03D7406E61F5D8B4B5701B459A",
                        "message_hash": "15CAAFF4027F8BDB018F989F2753B87DEA2C05E84AA688E379E7864960E79794",
                        "msid": "98",
                        "mtim": "1532421414",
                        "balance": "7999999.99119369209",
                        "status": "2",
                        "account_count": "1",
                        "port": "8003",
                        "ipv4": "172.16.222.101"
                    }
                ]
            }
        }';
    }

    public static function getBlockIds(): string
    {
        return '{
            "current_block_time": "1532421536",
            "previous_block_time": "1532421504",
            "tx": {
                "data": "13010000000000ABE5565B0000000000000000",
                "signature": "825147B1F0A799D935A15384BC905E3274ACE906FDCB2999713273FB2BAF63CCD28694076EEF23E'
            . 'E09A7C766950C72C67DB1BF815A484C9372432DD889D6FE0B",
                "time": "1532421547"
            },
            "updated_blocks": "5",
            "blocks": ["5B56C9E0", "5B56CA00", "5B56CA20", "5B56CA40", "5B56CA60"]
        }';
    }

    public static function getBroadcast(): string
    {
        return '{
            "current_block_time": "1532351072",
            "previous_block_time": "1532351040",
            "tx": {
                "data": "1201000100000040D2555B68D2555B",
                "signature": "2BB90103DF1E8E39CB38FA3A8E0733519010DE0B068278BEC039BA079FF8DEFFACCD7D436'
            . '886D220A80FD6A3AF1BEE20FA23E4287EE720F6A4A611BF42CDCB08",
                "time": "1532351080"
            },
            "block_time_hex": "5B55D240",
            "block_time": "1532351040",
            "broadcast_count": "1",
            "log_file": "archive",
            "broadcast": [{
                    "block_time": "1532351040",
                    "block_date": "2018-07-23 15:04:00",
                    "node": "1",
                    "account": "0",
                    "address": "0001-00000000-9B6F",
                    "account_msid": "26",
                    "time": "1532351047",
                    "date": "2018-07-23 15:04:07",
                    "data": "030100000000001A00000047D2555B0100",
                    "message": "7E",
                    "signature": "A12F210C3AC26CCCEAF19301C4985C9C1C86A45470729530C46FDC5999252492C17996F82735'
            . '9A10C35D456403D7B389D766324976A5145667B82E6193952D04",
                    "input_hash": "A79B8AC0561B9B7E2B9CB792714377D8DF864B30C87697FD967BA4505445C0A7",
                    "public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
                    "verify": "passed",
                    "node_msid": "58",
                    "node_mpos": "1",
                    "id": "0001:0000003A:0001",
                    "fee": "0.00000010000"
                }
            ]
        }';
    }

    public static function getLog(): string
    {
        return '{
            "current_block_time": "1539173408",
            "previous_block_time": "1539173376",
            "tx": {
                "data": "1101000000000002ECBD5B",
                "signature": "B74880E383FBE4F913A6A46E6D6BF0AB8C96F1F53BFA504566AA9C9611C188D34405'
            . '135B6B98626B34D53DFDB80A82C9A53F39F7626E86C42A705405F45D0D0B",
                "time": "1539173378",
                "account_msid": "0",
                "account_hashin": "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF",
                "account_hashout": "66EFEA9D75CD3D6F34DB78BBCFA70E52ED7C7FE310846A5FDAAB40E80E226614",
                "deduct": "0.00000000000",
                "fee": "0.00000000000"
            },
            "account": {
                "address": "0001-00000000-9B6F",
                "node": "1",
                "id": "0",
                "msid": "1",
                "time": "1539169920",
                "date": "2018-10-10 11:12:00",
                "status": "0",
                "paired_node": "0",
                "paired_id": "0",
                "local_change": "1539169920",
                "remote_change": "1539173376",
                "balance": "19999999.99733827406",
                "public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
                "hash": "3234990E04DCBDFF494ECA8C9EB0CA021E51C4E891573270D31AF648F7E00BDB"
            },
            "log": [
                {
                    "time": "1539169952",
                    "date": "2018-10-10 11:12:32",
                    "type_no": "32768",
                    "confirmed": "yes",
                    "type": "node_started",
                    "node_start_msid": "0",
                    "node_start_block": "0",
                    "account": {
                        "balance": "19999999.99999997000",
                        "local_change": "1539169920",
                        "remote_change": "1539169920",
                        "hash_prefix_8": "3234990E04DCBDFF",
                        "public_key_prefix_6": "A9C0D972D8AA",
                        "status": "0",
                        "msid": "1",
                        "node": "0",
                        "id": "0",
                        "address": "0000-00000000-313E"
                    },
                    "dividend": "0.00000000000"
                },
                {
                    "time": "1539169988",
                    "date": "2018-10-10 11:13:08",
                    "type_no": "32785",
                    "confirmed": "yes",
                    "type": "bank_profit",
                    "profit": "0.00000000000",
                    "node": "1",
                    "node_msid": "1",
                    "profit_txs": "0.00000000000",
                    "profit_div": "0.00000000000",
                    "fee": "0.00000004230"
                },
                {
                    "time": "1539169988",
                    "date": "2018-10-10 11:13:08",
                    "type_no": "32785",
                    "confirmed": "yes",
                    "type": "bank_profit",
                    "block_id": "5BBDDEA0",
                    "profit_put": "0.00000000000",
                    "profit_div": "0.00000000000",
                    "profit_usr": "0.00000000000",
                    "profit_get": "0.00000000000",
                    "profit_shared": "0.00000001692",
                    "profit": "0.00000001692",
                    "fee": "0.00000003000"
                },
                {
                    "time": "1539170020",
                    "date": "2018-10-10 11:13:40",
                    "type_no": "32785",
                    "confirmed": "yes",
                    "type": "bank_profit",
                    "block_id": "5BBDDEC0",
                    "profit_put": "0.00000000000",
                    "profit_div": "0.00000000000",
                    "profit_usr": "0.00000000000",
                    "profit_get": "0.00000000000",
                    "profit_shared": "0.00000000000",
                    "profit": "0.00000000000",
                    "fee": "0.00000003000"
                },
                {
                    "time": "1539170052",
                    "date": "2018-10-10 11:14:12",
                    "type_no": "32784",
                    "confirmed": "yes",
                    "type": "dividend",
                    "node_msid": "1",
                    "block_id": "5BBDDF00",
                    "dividend": "-0.00020000000"
                },
                {
                    "time": "1539170052",
                    "date": "2018-10-10 11:14:12",
                    "type_no": "32785",
                    "confirmed": "yes",
                    "type": "bank_profit",
                    "block_id": "5BBDDEE0",
                    "profit_put": "0.00000000000",
                    "profit_div": "0.00000000000",
                    "profit_usr": "0.00000000000",
                    "profit_get": "0.00000000000",
                    "profit_shared": "0.00000000000",
                    "profit": "0.00000000000",
                    "fee": "0.00000003000"
                },
                {
                    "time": "1539170084",
                    "date": "2018-10-10 11:14:44",
                    "type_no": "32785",
                    "confirmed": "yes",
                    "type": "bank_profit",
                    "profit": "0.00000000000",
                    "node": "1",
                    "node_msid": "2",
                    "profit_txs": "0.00000000000",
                    "profit_div": "0.00000000000",
                    "fee": "0.00000004197"
                },
                {
                    "time": "1539170084",
                    "date": "2018-10-10 11:14:44",
                    "type_no": "32785",
                    "confirmed": "yes",
                    "type": "bank_profit",
                    "block_id": "5BBDDF00",
                    "profit_put": "0.00000000000",
                    "profit_div": "0.00004000000",
                    "profit_usr": "0.00000000000",
                    "profit_get": "0.00000000000",
                    "profit_shared": "0.00000001678",
                    "profit": "0.00004001678",
                    "fee": "0.00000003000"
                },
                {
                    "time": "1539170116",
                    "date": "2018-10-10 11:15:16",
                    "type_no": "32785",
                    "confirmed": "yes",
                    "type": "bank_profit",
                    "block_id": "5BBDDF20",
                    "profit_put": "0.00000000000",
                    "profit_div": "0.00000000000",
                    "profit_usr": "0.00000000000",
                    "profit_get": "0.00000000000",
                    "profit_shared": "0.00000000000",
                    "profit": "0.00000000000",
                    "fee": "0.00000003000"
                }
            ]
        }
        ';
    }

    public static function getLogEmpty(): string
    {
        return '{
            "current_block_time": "1539173408",
            "previous_block_time": "1539173376",
            "tx": {
                "data": "1101000000000002ECBD5B",
                "signature": "B74880E383FBE4F913A6A46E6D6BF0AB8C96F1F53BFA504566AA9C96'
            . '11C188D34405135B6B98626B34D53DFDB80A82C9A53F39F7626E86C42A705405F45D0D0B",
                "time": "1539173378",
                "account_msid": "0",
                "account_hashin": "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF",
                "account_hashout": "66EFEA9D75CD3D6F34DB78BBCFA70E52ED7C7FE310846A5FDAAB40E80E226614",
                "deduct": "0.00000000000",
                "fee": "0.00000000000"
            },
            "account": {
                "address": "0001-00000000-9B6F",
                "node": "1",
                "id": "0",
                "msid": "1",
                "time": "1539169920",
                "date": "2018-10-10 11:12:00",
                "status": "0",
                "paired_node": "0",
                "paired_id": "0",
                "local_change": "1539169920",
                "remote_change": "1539173376",
                "balance": "19999999.99733827406",
                "public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
                "hash": "3234990E04DCBDFF494ECA8C9EB0CA021E51C4E891573270D31AF648F7E00BDB"
            },
            "log": ""
        }
        ';
    }

    public static function getMessage(): string
    {
        return '{
            "current_block_time": "1532012352",
            "previous_block_time": "1532012320",
            "tx": {
                "data": "1A02000100000046A7505B0000000003003B000000",
                "signature": "B476109568467C1EC1D9F2DCE3A0CAE2758D30504233274CAD64FB5581FB738214'
            . '2ADBAF0565A820D3144DC588924AA8D87B45C40E3D78920A87EF3679C5A002",
                "time": "1532012358"
            },
            "block_id": "5B50A6A0",
            "message_id": "0003:0000003B",
            "node": "3",
            "node_msid": "59",
            "time": "1532012203",
            "length": "308",
            "hash": "CA4F8EBC994E7A15B163A8DA3BED30D193D3867BFF758F3CACBB4DB4EC9D1B0C",
            "transactions": [{
                    "id": "0003:0000003B:0001",
                    "type": "log_account",
                    "node": "3",
                    "user": "0",
                    "msg_id": "1",
                    "time": "1532012198",
                    "signature": "0D15530D8F728F88311C93D244E6FF2CFA445F38C406013598753BDC0CE48C51A5423'
            . '0B2C86A7BAF95F891D8E7C2E7A31C014A136DBE7BD05984517E9A9D7A05",
                    "network_account": {
                        "address": "0003-00000000-DFEC",
                        "node": "3",
                        "id": "0",
                        "msid": "1",
                        "time": "1532008192",
                        "date": "2018-07-19 15:49:52",
                        "status": "0",
                        "paired_node": "3",
                        "paired_id": "0",
                        "local_change": "1532008192",
                        "remote_change": "1532012160",
                        "balance": "7999999.99503635570",
                        "public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
                        "hash": "FBC03828DDC71C22772CED81DFCEEBC62F74E8A4B185B47746424BF38C966DA8",
                        "checksum": "true"
                    },
                    "size": "207"
                }, {
                    "id": "0003:0000003B:0002",
                    "type": "connection",
                    "port": "8003",
                    "ip_address": "172.16.222.101",
                    "version": "@",
                    "size": "23"
                }
            ]
        }';
    }

    public static function getMessageIds(): string
    {
        return '{
            "current_block_time": "1532077312",
            "previous_block_time": "1532077280",
            "tx": {
                "data": "190200000000000EA5515BE0A3515B",
                "signature": "C33CB56C758FEBAD18D50592350BD720F9143E9CAB06BD981757D'
            . 'CE8D36DE18DB47F9CC7FAEC406C13BDB58EBAA323878C36D69825528C1F33C1A31E1572530F",
                "time": "1532077326"
            },
            "block_time_hex": "5B51A3E0",
            "block_time": "1532077024",
            "msghash": "CC2969C3524B5B94D7835E85FB972AFCF6091256DAC64527D5DB5A67673C3868",
            "message_count": "7",
            "confirmed": "yes",
            "messages": ["0001:00000001", "0001:00000002", "0001:00000003", "0002:00000001", '
            . '"0002:00000002", "0002:00000003", "0003:00000001"]
        }';
    }

    public static function getTransactionSendOne(): string
    {
        return '{
            "current_block_time": "1532347520",
            "previous_block_time": "1532347488",
            "tx": {
                "data": "140100000000009FC4555B0100030000000100",
                "signature": "4D4C4745E1D797FC5D0A3EBD870E3F9144C37F6CE3D6161928AA86D648478F0727761EDBD1EB4308E'
            . 'A293E640FA98772480B98F211697E47715352AF6C713E02",
                "time": "1532347551",
                "account_msid": "0",
                "account_hashin": "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF",
                "account_hashout": "25D5E0068EFE8F7CBCD9C407F2C9A42A96C56B66B4104B99185A0CF69C531A0F",
                "deduct": "0.00000000000",
                "fee": "0.00000000000"
            },
            "network_tx": {
                "id": "0001:00000003:0001",
                "block_time": "1532347488",
                "block_id": "5B55C460",
                "node": "1",
                "node_msid": "3",
                "node_mpos": "1",
                "size": "125",
                "hashpath_size": "6",
                "data": "040100000000000100000077C4555B010001000000'
            . '00A0724E1809000000000000000000000000000000000000000000'
            . '0000000000000000000000000041503FB1E7BD84A3A94685FAC3841A53374DE00A3260ED5A88D4877585EAFA982E828DDA9'
            . '9F57EA3B20DAF4723BCD6325F63042A1ED13724CB7279CF728D940A",
                "hashpath": ["36976DC64EDC80AC9A72EFDE80BDDD323A5FA08A8CB44D5BB7D5A6555AA0DBCB", '
            . '"D37BF29BFAB387537A0ABBCE955386BFE004887232AC7F29AD2D661EBAD78B5A", '
            . '"E9CA4D62A2367A6C3885D46B02A763DECEBC9160EEC2C4C894858290F5B246BD", '
            . '"3411C500E1217CA657E2BF79C2D3597A9B5D71075E4FA7312854847025885923", '
            . '"AE2453CC3156712280AE2B410A938263167AFE13CDA61FD373372309773F0718", '
            . '"B17412D4BB2909C03E6D168652AF93C5B5045B4FFE40C2F487171AA3EF198A0F"]
            },
            "txn": {
                "type": "send_one",
                "node": "1",
                "user": "0",
                "msg_id": "1",
                "time": "1532347511",
                "target_node": "1",
                "target_user": "1",
                "sender_fee": "0.05000000000",
                "sender_address": "0001-00000000-9B6F",
                "target_address": "0001-00000001-8B4E",
                "amount": "100.00000000000",
                "message": "0000000000000000000000000000000000000000000000000000000000000000",
                "signature": "41503FB1E7BD84A3A94685FAC3841A53374DE00A3260ED5A88D4877585EAFA982E828DDA99F57EA3B20DAF472'
            . '3BCD6325F63042A1ED13724CB7279CF728D940A"
            }
        }';
    }

    public static function sendOne(): string
    {
        return '{
            "current_block_time": "1532415264",
            "previous_block_time": "1532415232",
            "tx": {
                "data": "040100000000000300000027CD565B01000100000040420F000000000046'
            . '066ADCA3C787BF6874CE3361EECF7A9969D98F12719DF53440172B5A7D345A",
                "signature": "DABDDABFC25B0C76E33C0E6285F09695EE0193D10DBBC3F2CA39E8183603D7BDC5'
            . 'F62C14FF60A2EFCC23784F7FA380C6F38A2AD6B7DFB95FA2DCA9BA76D04503",
                "time": "1532415271",
                "account_msid": "3",
                "account_hashin": "8592795CE4EE7AAEEC7BA0EBCB4E5B83DF0151B009363FECB99EB39B62549343",
                "account_hashout": "04D526CB20CCE3003B8A2103C5401ABBCAA3F42D03C2392629B6CF923F66323B",
                "deduct": "0.00001010000",
                "fee": "0.00000010000",
                "node_msid": "13",
                "node_mpos": "2",
                "id": "0001:0000000D:0002"
            },
            "account": {
                "address": "0001-00000000-9B6F",
                "node": "1",
                "id": "0",
                "msid": "4",
                "time": "1532415271",
                "date": "2018-07-24 08:54:31",
                "status": "0",
                "paired_node": "1",
                "paired_id": "0",
                "local_change": "1532415264",
                "remote_change": "1532415232",
                "balance": "19999699.84935875759",
                "public_key": "A9C0D972D8AAB73805EC4A28291E052E3B5FAFE0ADC9D724917054E5E2690363",
                "hash": "04D526CB20CCE3003B8A2103C5401ABBCAA3F42D03C2392629B6CF923F66323B"
            }
        }';
    }
}
