# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]
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
 
[Unreleased]: https://github.com/adshares/ads-php-client/compare/v1.0.1...HEAD
 
[1.0.1]: https://github.com/adshares/ads-php-client/compare/v1.0.0...v1.0.1
[1.0.0]: https://github.com/adshares/ads-php-client/releases/tag/v1.0.0
