<div align="center">
  <a href="https://adshares.net/">
    <img src="https://adshares.net/logos/ads.svg" alt="Adshares" width=72 height=72>
  </a>
  <h3 align="center"><small>ADS PHP Client</small></h3>
  <p align="center">
    <a href="https://github.com/adshares/ads-php-client/issues/new?template=bug_report.md&labels=Bug">Report bug</a>
    ·
    <a href="https://github.com/adshares/ads-php-client/issues/new?template=feature_request.md&labels=New%20Feature">Request feature</a>
    ·
    <a href="https://docs.adshares.net/ads-php-client/index.html">Docs</a>
  </p>
</div>

<br>

ADS PHP Client is an object-oriented **PHP 7.4/8.0** client for the [ADS blockchain](https://github.com/adshares/ads) API.

This library depends on [Symfony Process](http://symfony.com/doc/current/components/process.html).


[![Quality Status](https://sonarcloud.io/api/project_badges/measure?project=adshares-ads-php-client&metric=alert_status)](https://sonarcloud.io/dashboard?id=adshares-ads-php-client)
[![Reliability Rating](https://sonarcloud.io/api/project_badges/measure?project=adshares-ads-php-client&metric=reliability_rating)](https://sonarcloud.io/dashboard?id=adshares-ads-php-client)
[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=adshares-ads-php-client&metric=security_rating)](https://sonarcloud.io/dashboard?id=adshares-ads-php-client)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=adshares-ads-php-client&metric=coverage)](https://sonarcloud.io/dashboard?id=adshares-ads-php-client)
[![Build Status](https://travis-ci.com/adshares/ads-php-client.svg?branch=master)](https://travis-ci.com/adshares/ads-php-client)


## Getting Started

Several quick start options are available:

- Install with [Composer](https://getcomposer.org/) (recommended): `composer require adshares/ads-client`
- [Download the latest release](https://github.com/adshares/ads-php-client/releases/latest)
- Clone the repo: `git clone https://github.com/adshares/ads-php-client.git`

To connect to the node, you will need to provide an account address and a secret key.
Usually you will also need to specify a host name and a port.
Once you know the proper parameters, you should be able to connect like this:

```
$address = 'FFFF-00000001-AAAA';
$secret = 'EFD0380D9B29829AE9F30F41E85D6C09A97220E6CF76FE8C1B479A34A38D12EC';
$host = '127.0.0.1';
$port = 6511;

$client = new AdsClient(new CliDriver($address, $secret, $host, $port));
```

Then you can call ADS commands, for example, to get the current status of the user:

```
$response = $client->getMe();
```

### Documentation

- [Installation](https://docs.adshares.net/ads-php-client/installation.html)
- [Usage](https://docs.adshares.net/ads-php-client/usage.html)
- [Tests](https://docs.adshares.net/ads-php-client/tests.html)

### Contributing

Please follow our [Contributing Guidelines](docs/CONTRIBUTING.md)

### Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/adshares/ads-php-client/tags). 


## Authors

- **[Paweł Podkalicki](https://github.com/PawelPodkalicki)** - _main programmer_
- **[Maciej Pilarczyk](https://github.com/m-pilarczyk)** - _architecture, supervision_

See also the list of [contributors](https://github.com/adshares/ads-php-client/contributors) who participated in this project.

### License

This project is licensed under the GNU General Public License v3.0 - see the [LICENSE](LICENSE) file for details.

## More info

- [ADS Blockchain docs](https://docs.adshares.net/ads/)
- [ADS JS Client](https://github.com/adshares/ads-js-client)
