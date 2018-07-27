[![Quality Status](https://sonarcloud.io/api/project_badges/measure?project=adshares-php-ads-client&metric=alert_status)](https://sonarcloud.io/dashboard?id=adshares-php-ads-client "Master")
[![Build Status](https://travis-ci.org/adshares/php-ads-client.svg?branch=master)](https://travis-ci.org/adshares/php-ads-client "Master")
[![Build Status](https://travis-ci.org/adshares/php-ads-client.svg?branch=develop)](https://travis-ci.org/adshares/php-ads-client "Develop")

# PHP ADS Client
PHP API for our ADS blockchain

### Usage
Initialize CliDriver (Command line Driver) with ADS blockchain credentials 
(account address, private key, node host and port).
```
$driver = new CliDriver($this->address, $this->secret, $this->host, $this->port);
```
Please, note that by default CliDriver
uses `ads` as ADS blockchain client application
and saves cache to `~/.ads` directory.
This behaviour can be overwritten with `$driver->setCommand(string)` and `$driver->setWorkingDir(string)` methods.

Initialize client with driver.
```
$client = new AdsClient($driver);
```
Call commands using created client. In current version client supports all block explorer commands and basic transaction.
 
 Supported block explorer commands:
 - getAccount,
 - getAccounts,
 - getBlock,
 - getBlockIds,
 - getBroadcast,
 - getMe,
 - getMessage,
 - getMessageIds,
 - getTransaction.
 
 Supported transactions:
 - broadcast,
 - sendMany,
 - sendOne.