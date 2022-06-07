# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.3.0] - 2022-06-07
### Added
- Symfony 6.0 support

## [1.2.3] - 2021-10-13
### Changed
- Replace DateTime by DateTimeInterface
- Replacing XXXX during address normalization

## [1.2.2] - 2021-08-18
### Fixed
- Round clicks in ads conversion

## [1.2.1] - 2021-07-20
### Added
- PHP 8.0 support
- Composer 2.0 support
- Symfony 5.0 support
- PSR12 formatting

## [1.2.0] - 2018-10-10
### Added
- Function `get_log`

## [1.1.0] - 2018-09-24
### Added
- Transaction `change_account_key`, `change_node_key`, `create_account`, `create_node`

### Changed
- Function `getAccounts` takes nodeId as hex instead of int
- Fix duplicated code in transaction address getters
- AdsValidator checks address checksum
- Missing ads error description
- Client accepts whitespace characters at the beginning and end of a response

## [1.0.1] - 2018-08-22
### Added
- Getters sender/target address to transaction entities where applicable.

## [1.0.0] - 2018-08-01
### Added
- Support for all block explorer commands:
  - getAccount,
  - getAccounts,
  - getBlock,
  - getBlockIds,
  - getBroadcast,
  - getMe,
  - getMessage,
  - getMessageIds,
  - getTransaction.
- Support for basic transactions:
  - broadcast,
  - sendMany,
  - sendOne.
- Readme
- License
- Changelog
- Contributing
 
[Unreleased]: https://github.com/adshares/ads-php-client/compare/v1.3.0...HEAD

[1.3.0]: https://github.com/adshares/ads-php-client/compare/v1.2.3...v1.3.0
[1.2.3]: https://github.com/adshares/ads-php-client/compare/v1.2.2...v1.2.3
[1.2.2]: https://github.com/adshares/ads-php-client/compare/v1.2.1...v1.2.2
[1.2.1]: https://github.com/adshares/ads-php-client/compare/v1.2.0...v1.2.1
[1.2.0]: https://github.com/adshares/ads-php-client/compare/v1.1.0...v1.2.0
[1.1.0]: https://github.com/adshares/ads-php-client/compare/v1.0.1...v1.1.0
[1.0.1]: https://github.com/adshares/ads-php-client/compare/v1.0.0...v1.0.1
[1.0.0]: https://github.com/adshares/ads-php-client/releases/tag/v1.0.0
