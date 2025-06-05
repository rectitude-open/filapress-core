# FilaPress Core

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rectitude-open/filapress-core.svg?style=flat-square)](https://packagist.org/packages/rectitude-open/filapress-core)
[![Tests](https://github.com/rectitude-open/filapress-core/actions/workflows/run-tests.yml/badge.svg)](https://github.com/rectitude-open/filapress-core/actions/workflows/run-tests.yml)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%205-brightgreen)](https://phpstan.org/)
[![Total Downloads](https://img.shields.io/packagist/dt/rectitude-open/filapress-core.svg?style=flat-square)](https://packagist.org/packages/rectitude-open/filapress-core)
[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat-square)](https://github.com/rectitude-open/filapress-core/pulls)

This is the core package for [FilaPress](https://github.com/rectitude-open/filapress). It acts as a central integration point, bundling various Filament plugins and managing their policies, configurations, and migrations. FilaPress itself relies on this single core package, which then orchestrates other underlying plugins, simplifying overall extension management.

## Installation

You can install the package via composer:

```bash
composer require rectitude-open/filapress-core
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filapress-core-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filapress-core-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filapress-core-views"
```

## Usage

```php
$filapressCore = new RectitudeOpen\FilaPressCore();
echo $filapressCore->echoPhrase('Hello, RectitudeOpen!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Rectitude Open](https://github.com/rectitude-open)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
