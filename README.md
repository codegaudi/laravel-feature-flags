# Laravel-Feature-Flags

[![Latest Version on Packagist](https://img.shields.io/packagist/v/samuelnitsche/laravel-feature-flags.svg?style=flat-square)](https://packagist.org/packages/samuelnitsche/laravel-feature-flags)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/samuelnitsche/laravel-feature-flags/Tests/master?style=flat-square)](https://github.com/samuelnitsche/laravel-feature-flags/actions?query=workflow%3ATests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/samuelnitsche/laravel-feature-flags.svg?style=flat-square)](https://packagist.org/packages/samuelnitsche/laravel-feature-flags)

Laravel-Feature-Flags is a package which aims to add simple and easy to use feature flagging functionality to Laravel.

## What is feature flagging?

Feature flagging is a way to enable and disable features in your application.

For example:
* Push your new feature to production but enable it at a moment in the future
* Enable new features for small set of users

This package allows you to define a feature and
* enable or disable it globally
* enable or disable it for any type of model in your application

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

## Usage

First of all you have to define a new feature. Features are just normal eloquent models so you can create a new feature like this.
```php
Feature::create([
    'name' => 'my-feature',
    'is_enabled' => true,
]);
```

You can check if a feature is enabled using the `isEnabled` and `isDisabled` methods.

```php
$feature->isEnabled();
$feature->isDisabled();
```

Of course you can add features to a model. You need to add the `HasFeatures` trait to the class of your choice

```php
use SamuelNitsche\LaravelFeatureFlags\Traits\HasFeatures;

class User extends Model
{
    use HasFeatures;
}
```

Next, enable the feature using the `enableFeature` method.

```php
$user = User::first();
$feature = Feature::whereName('my-feature')->first();
$user->enableFeature($feature);
```

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
