# FilaPress Core

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rectitude-open/filapress-core.svg?style=flat-square)](https://packagist.org/packages/rectitude-open/filapress-core)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%205-brightgreen)](https://phpstan.org/)
[![Total Downloads](https://img.shields.io/packagist/dt/rectitude-open/filapress-core.svg?style=flat-square)](https://packagist.org/packages/rectitude-open/filapress-core)
[![CI](https://github.com/rectitude-open/filapress-core/actions/workflows/ci.yml/badge.svg)](https://github.com/rectitude-open/filapress-core/actions/workflows/ci.yml)
[![Integration Test](https://github.com/rectitude-open/filapress-core/actions/workflows/integration-test.yml/badge.svg)](https://github.com/rectitude-open/filapress-core/actions/workflows/integration-test.yml)
[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat-square)](https://github.com/rectitude-open/filapress-core/pulls)

This is the core package for [FilaPress](https://github.com/rectitude-open/filapress). It acts as a central integration point, bundling various Filament plugins and managing their policies, configurations, and migrations. FilaPress itself relies on this single core package, which then orchestrates other underlying plugins, simplifying overall extension management.

### Filament Plugins

FilaPress stands on the shoulders of giants. We express our sincere gratitude to the developers of these plugins that make our system possible.

| Plugin                          | Author                                               | License | Documentation                                                                  |
| ------------------------------- | ---------------------------------------------------- | ------- | ------------------------------------------------------------------------------ |
| Shield                          | [Bezhan Salleh](https://github.com/bezhanSalleh)     | MIT     | [Documentation](https://github.com/bezhansalleh/filament-shield)               |
| Filament Curator                | [Adam Weston](https://github.com/awcodes)            | MIT     | [Documentation](https://github.com/awcodes/filament-curator)                   |
| Filament Users Manager          | [TomatoPHP](https://github.com/tomatophp)            | MIT     | [Documentation](https://github.com/tomatophp/filament-users)                   |
| Activity logger for filament    | [ZedoX](https://github.com/Z3d0X)                    | MIT     | [Documentation](https://github.com/z3d0x/filament-logger)                      |
| Filament Spatie Settings Plugin | [Filament](https://github.com/filamentphp)           | MIT     | [Documentation](https://github.com/filamentphp/spatie-laravel-settings-plugin) |
| Filament Spatie Tags Plugin     | [Filament](https://github.com/filamentphp)           | MIT     | [Documentation](https://github.com/filamentphp/spatie-laravel-tags-plugin)     |
| Filament Tree                   | [Solution Forest](https://github.com/solutionforest) | MIT     | [Documentation](https://github.com/solutionforest/filament-tree)               |
| Filament Versionable            | [Mansoor Khan](https://github.com/mansoorkhan96)     | MIT     | [Documentation](https://github.com/mansoorkhan96/filament-versionable)         |
| Filament SEO                    | [Ralph J. Smit](https://github.com/ralphjsmit)       | MIT     | [Documentation](https://github.com/ralphjsmit/laravel-filament-seo)            |
| Themes for Filament panels      | [Nehal Hasnayeen](https://github.com/Hasnayeen)      | MIT     | [Documentation](https://github.com/hasnayeen/themes)                           |
| Filament Select Tree            | [Dennis](https://github.com/CodeWithDennis)          | MIT     | [Documentation](https://github.com/solutionforest/filament-tree)               |
| Filament Captcha                | [Marco Germani](https://github.com/marcogermani87)   | MIT     | [Documentation](https://github.com/marcogermani87/filament-captcha)            |
| Filament Laravel Auditing       | [Tapp Network](https://github.com/TappNetwork)       | MIT     | [Documentation](https://github.com/TappNetwork/filament-auditing)              |
| Mail Log                        | [Tapp Network](https://github.com/TappNetwork)       | MIT     | [Documentation](https://github.com/TappNetwork/filament-maillog)               |
| Filament News                   | [Rectitude Open](https://github.com/rectitude-open)  | MIT     | [Documentation](https://github.com/rectitude-open/filament-news)               |
| Filament Site Snippets          | [Rectitude Open](https://github.com/rectitude-open)  | MIT     | [Documentation](https://github.com/rectitude-open/filament-site-snippets)      |
| Filament Info Pages             | [Rectitude Open](https://github.com/rectitude-open)  | MIT     | [Documentation](https://github.com/rectitude-open/filament-info-pages)         |
| Filament TinyMCE Editor 6       | [Rectitude Open](https://github.com/rectitude-open)  | MIT     | [Documentation](https://github.com/rectitude-open/filament-tinyeditor-6)       |
| Filament Info Alert             | [Rectitude Open](https://github.com/rectitude-open)  | MIT     | [Documentation](https://github.com/rectitude-open/filament-info-alert)         |
| Filament Contact Logs           | [Rectitude Open](https://github.com/rectitude-open)  | MIT     | [Documentation](https://github.com/rectitude-open/filament-contact-logs)       |
| Filament Site Navigation        | [Rectitude Open](https://github.com/rectitude-open)  | MIT     | [Documentation](https://github.com/rectitude-open/filament-site-navigation)    |
| Filament System Settings        | [Rectitude Open](https://github.com/rectitude-open)  | MIT     | [Documentation](https://github.com/rectitude-open/filament-system-settings)    |
| Filament Ban Manager            | [Rectitude Open](https://github.com/rectitude-open)  | MIT     | [Documentation](https://github.com/rectitude-open/filament-ban-manager)        |

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Aspirant Zhang](https://github.com/aspirantzhang)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
