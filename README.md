# laravel-feature-flags

**THIS PACKAGE IS CURRENTLY UNDER HEAVY DEVELOPMENT. DO NOT USE IN PRODUCTION YET.**

[![Latest Version on Packagist](https://img.shields.io/packagist/v/samuelnitsche/laravel-feature-flags.svg?style=flat-square)](https://packagist.org/packages/samuelnitsche/laravel-feature-flags)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/samuelnitsche/laravel-feature-flags/run-tests?label=tests)](https://github.com/samuelnitsche/laravel-feature-flags/actions?query=workflow%3ATests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/samuelnitsche/laravel-feature-flags.svg?style=flat-square)](https://packagist.org/packages/samuelnitsche/laravel-feature-flags)


TBD

## Installation

You can install the package via composer:

```bash
composer require samuelnitsche/laravel-feature-flags
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="SamuelNitsche\LaravelFeatureFlags\LaravelFeatureFlagsServiceProvider" --tag="migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="SamuelNitsche\LaravelFeatureFlags\LaravelFeatureFlagsServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

TBD

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Samuel Nitsche](https://github.com/SamuelNitsche)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
