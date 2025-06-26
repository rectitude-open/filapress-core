# Changelog

## [1.7.0](https://github.com/rectitude-open/filapress-core/compare/v1.6.0...v1.7.0) (2025-06-26)


### Features

* add HTMLPurifier for Laravel and article setting ([4036f3b](https://github.com/rectitude-open/filapress-core/commit/4036f3babd70ba433783623bdebaeec69db9914d))
* add PHPStan ignore directive for view-site-button render hook ([342a55b](https://github.com/rectitude-open/filapress-core/commit/342a55b9db9a722773d6a3efab1bd09dbf61dd7c))
* add RichEditor component class to site snippets configuration ([485535b](https://github.com/rectitude-open/filapress-core/commit/485535baaab813dcfb62accbb7223b97f856de1d))
* add site URL setting to application settings migration ([39e0336](https://github.com/rectitude-open/filapress-core/commit/39e0336bb313599327734fbde9e5f9b0a4908c00))
* add view site button component and register render hook in service provider ([317324a](https://github.com/rectitude-open/filapress-core/commit/317324af38bc5be87c0de3443c03182225045b6e))
* enhance news tests with form field checks and pagination support ([160eddd](https://github.com/rectitude-open/filapress-core/commit/160eddd676d92801b0140a877d08caded4c0f88a))
* update dependencies ([3929a99](https://github.com/rectitude-open/filapress-core/commit/3929a994e964ebddaae9883887091ba071e1ad58))
* Update dependencies and PHPStan configuration ([c3649a3](https://github.com/rectitude-open/filapress-core/commit/c3649a3e47a94898e7f06423486a60dbc8a02b1c))
* update info pages config and dependencies ([03d1a18](https://github.com/rectitude-open/filapress-core/commit/03d1a18e9ecbd3772ca28c043039cea1e3144c3a))
* update rectitude-open/filament-site-navigation version to ^1.1 in composer files ([ce6ed63](https://github.com/rectitude-open/filapress-core/commit/ce6ed6345dfff5a4612c3c185943f9b4ae27ead6))
* update site navigations migration to include additional fields and remove soft deletes ([7e73de3](https://github.com/rectitude-open/filapress-core/commit/7e73de3e8151b9781a24abb04630a9913251c3b2))
* update site snippets version ([8424425](https://github.com/rectitude-open/filapress-core/commit/84244252a43bec9811a4bcf3fa354563ec9714d4))
* update system settings version and enhance system settings configuration ([0149cd9](https://github.com/rectitude-open/filapress-core/commit/0149cd903c63e2593f193c572c9c3cfcea8dc006))


### Bug Fixes

* adjust toolbar formatting in default profile for clarity ([9e4558d](https://github.com/rectitude-open/filapress-core/commit/9e4558d70409e2b16daacb66be27697021e4720e))
* enhance integration script to support test filtering ([8e2d415](https://github.com/rectitude-open/filapress-core/commit/8e2d415a9d3501eeaae795549098f668ca98d18f))


### Miscellaneous Chores

* **deps:** bump rectitude-open/filament-site-snippets ([1e8c30d](https://github.com/rectitude-open/filapress-core/commit/1e8c30dc23550a53b2e29af414902466bd53d323))
* **deps:** bump rectitude-open/filament-site-snippets from 1.3.0 to 1.4.0 ([4e6619f](https://github.com/rectitude-open/filapress-core/commit/4e6619fc2023348c7d7ea73a5fcc08270bb2d901))

## [1.6.0](https://github.com/rectitude-open/filapress-core/compare/v1.5.0...v1.6.0) (2025-06-15)


### Features

* add admin panel accessibility test and update test execution command ([f7a85c8](https://github.com/rectitude-open/filapress-core/commit/f7a85c8b458e56b7898524d1d46fff9fe0073ac5))
* add CI workflow for PHP setup, dependency management, and testing ([bdd7c8c](https://github.com/rectitude-open/filapress-core/commit/bdd7c8ca2b9fa316bed0c065d9f645c7fa13f971))
* add GitHub Actions workflow for release automation ([94556e9](https://github.com/rectitude-open/filapress-core/commit/94556e9b5a347f0eb77db7b588481b67d7bbb237))
* add integration test for admin panel accessibility and update docker-compose for testing environment ([dcff860](https://github.com/rectitude-open/filapress-core/commit/dcff860a9d7ae83f1b03d22c18c5751980cc3b49))
* add integration test workflow and remove obsolete workflows ([41861ee](https://github.com/rectitude-open/filapress-core/commit/41861eefdfe514ca7feaf8301cde24eff008294b))
* add migrations for built-in plugins ([22ada1e](https://github.com/rectitude-open/filapress-core/commit/22ada1e2be19f4f273bfe4e8caaa42cd242dc62a))
* enhance admin panel tests with login validation and accessibility checks ([012cf2b](https://github.com/rectitude-open/filapress-core/commit/012cf2bdeae55ccbe3370924e00edf19fca655b6))
* implement dynamic plugin registration based on configuration ([41e2d55](https://github.com/rectitude-open/filapress-core/commit/41e2d551707297e04d253cec04a804698e93870f))
* update dependencies ([0807594](https://github.com/rectitude-open/filapress-core/commit/0807594871a09e6d375c04231f378a46e08ce781))
* update filament-news version and configs ([4dcf73b](https://github.com/rectitude-open/filapress-core/commit/4dcf73be4e75fb908690c48e2c5390eedd855536))
* use Curator instead of Media Manager ([4173436](https://github.com/rectitude-open/filapress-core/commit/41734365422e712099cbc2b30f0b7b8025e7bc52))


### Bug Fixes

* conditionally fill login form with credentials in local and testing environments ([52a3b8d](https://github.com/rectitude-open/filapress-core/commit/52a3b8d5a22556d9eed068d918325cde6b7ca401))
* correct casing in runner.os for vendor cache key in CI workflow ([ed65688](https://github.com/rectitude-open/filapress-core/commit/ed656880ea58f644eb1d746ff5ef7cecee5f150d))
* correct command for Pint test execution in CI workflow ([ba6e933](https://github.com/rectitude-open/filapress-core/commit/ba6e9335163d38a40612c73efe977b3d6ed0d752))
* rename workflow from CI to Integration Test for clarity ([6c607b2](https://github.com/rectitude-open/filapress-core/commit/6c607b25f99487a9c29c1ad1f33b0d0a8dffdb9a))
* update composer command to install dependencies without specifying the core package ([2a1ded3](https://github.com/rectitude-open/filapress-core/commit/2a1ded307d221560a9c431a67886ad59e9770ae9))
* update test command path in integration test workflow ([87cf470](https://github.com/rectitude-open/filapress-core/commit/87cf4708b69a3c4ff04c94ecc874d465b1fe49da))
* update test path in integration workflow to run integration tests ([c39857e](https://github.com/rectitude-open/filapress-core/commit/c39857ee5383eb552d7d47abb22cee7b19af51ff))


### Miscellaneous Chores

* **deps:** bump rectitude-open/filament-news from 1.5.0 to 1.7.0 ([fe1e3b9](https://github.com/rectitude-open/filapress-core/commit/fe1e3b95ac1c3d82f337ae451d86c2d2142ed7ca))
* **deps:** bump rectitude-open/filament-news from 1.5.0 to 1.7.0 ([42c2cd7](https://github.com/rectitude-open/filapress-core/commit/42c2cd7f91b65846290766312d35a8a5f74a9639))
* update README to remove installation and usage sections, and adjust credits ([08b8580](https://github.com/rectitude-open/filapress-core/commit/08b858039b018578aba04154481b08a6a1499db3))

## [1.5.0](https://github.com/rectitude-open/filapress-core/compare/v1.4.0...v1.5.0) (2025-06-07)


### Features

* add event listeners for saving and saved settings ([2851bca](https://github.com/rectitude-open/filapress-core/commit/2851bca80b5d666d3053d02c4dbc4a401a86d486))
* update action icons for create and submit in BaseCreateRecord and BaseEditRecord ([3524c10](https://github.com/rectitude-open/filapress-core/commit/3524c1010c2d726d5cf6c91281c6206c8bcebe51))

## [1.4.0](https://github.com/rectitude-open/filapress-core/compare/v1.3.0...v1.4.0) (2025-06-05)


### Features

* add captcha support to login process and implement related notifications ([54b10ad](https://github.com/rectitude-open/filapress-core/commit/54b10ad880db2dc1f894b5b34ac31d5c2284cb85))
* add configs for built-in plugins ([1dcd9d2](https://github.com/rectitude-open/filapress-core/commit/1dcd9d2c213ab621381d12508ee25ea4daf07b4d))
* add custom resource for info pages ([307ee66](https://github.com/rectitude-open/filapress-core/commit/307ee668537d03bb6749c6b93bb9efe15b9ea1d7))
* add custom resource for news ([5ea541e](https://github.com/rectitude-open/filapress-core/commit/5ea541ed16bc8a815b274f6a623e2c0449db8264))
* add export-ignore for filapress-core-docker and dev directories ([2b49ebc](https://github.com/rectitude-open/filapress-core/commit/2b49ebc9c16a449369f0f14487d6033797f54165))
* add filament media manager ([6f326e1](https://github.com/rectitude-open/filapress-core/commit/6f326e1fbd8fd3fedac6e269add7f003ac6e924e))
* add filament site snippet plugin ([5a5cf99](https://github.com/rectitude-open/filapress-core/commit/5a5cf99aea86f348e9154bfaa201ff923bb1ad89))
* add more configs ([8790902](https://github.com/rectitude-open/filapress-core/commit/8790902a4e8e5cab836aeb41bbee92e7ade8b212))
* add SetTheme middleware to FilaPressCorePlugin ([bb5a63a](https://github.com/rectitude-open/filapress-core/commit/bb5a63afb2d130ca9c2df59d9cbe4f8f3c7c1dfb))
* add site navigation feature with policy implementation ([5606dfb](https://github.com/rectitude-open/filapress-core/commit/5606dfbdbddb15f56e4d0526403a6fd40af9cf1e))
* add SiteSnippetPolicy for managing site snippet permissions ([83bbbf5](https://github.com/rectitude-open/filapress-core/commit/83bbbf5601d6d1a5af8c08fa3af9a52ef0db6222))
* add strict types declaration across multiple files and introduce pint.json configuration ([5ddc5cb](https://github.com/rectitude-open/filapress-core/commit/5ddc5cb5572febea7b8abcae347d90565ac0ff7b))
* add theme support ([9e14f0a](https://github.com/rectitude-open/filapress-core/commit/9e14f0a511bb1fc96d1fe3295b13d1fe18542742))
* enhance FilaPressCorePlugin with color configuration and IP banning middleware ([e8e3c32](https://github.com/rectitude-open/filapress-core/commit/e8e3c32a4adc03d01019bb6fc741f92c84d46c9a))
* integrate FilamentCaptcha plugin into FilaPressCorePlugin ([7c5e37a](https://github.com/rectitude-open/filapress-core/commit/7c5e37ad99488cc176669b148168ad80bde6a124))
* update cancel action color in BaseRevisionsPage ([500f3e9](https://github.com/rectitude-open/filapress-core/commit/500f3e962af13331864fe14f483bec7186b41c85))
* update filament news ([69bc236](https://github.com/rectitude-open/filapress-core/commit/69bc236299f5e8d62f20ad3f2bdb06cc066c3e8a))
* update filament-contact-logs dependency to version 1.3 and add configuration file ([6ede543](https://github.com/rectitude-open/filapress-core/commit/6ede543c38e01d415b7596a196f0bafc43a3b8a7))
* update README.md to enhance package description and remove unnecessary sections ([97e19d6](https://github.com/rectitude-open/filapress-core/commit/97e19d6dcbcf64791fe442901d68a96ae3eaa79c))

## [1.3.0](https://github.com/rectitude-open/filapress-core/compare/v1.2.0...v1.3.0) (2025-05-20)


### Features

* add activity logger feature ([6ebda75](https://github.com/rectitude-open/filapress-core/commit/6ebda75246fe10610d9422a39585b9402bc61fb5))
* add contact logs management with policy implementation ([d3bc3c2](https://github.com/rectitude-open/filapress-core/commit/d3bc3c26a067d4399be2d6084a318ed630257d2d))
* add pages feature ([769a39a](https://github.com/rectitude-open/filapress-core/commit/769a39a15d87e1274b5e91d600d7cd831f99a1b7))
* add system settings feature ([716c72d](https://github.com/rectitude-open/filapress-core/commit/716c72d3a69a98a939fcd81b735158780e258fba))

## [1.2.0](https://github.com/rectitude-open/filapress-core/compare/v1.1.0...v1.2.0) (2025-05-15)


### Features

* add Admin and Role policies for authorization ([eb5d973](https://github.com/rectitude-open/filapress-core/commit/eb5d973712e33f1695b49d98322b05e1060d5967))
* add filament shield configuration file ([490de9a](https://github.com/rectitude-open/filapress-core/commit/490de9a2523c2440c17c18f8008e5cc9fe77301e))
* add filament-ban-manager ([3791f3b](https://github.com/rectitude-open/filapress-core/commit/3791f3bd9e2e7e366fa929173476c3d9a39c2d1d))
* add MailLog resource, policy, and configuration ([0b6c04d](https://github.com/rectitude-open/filapress-core/commit/0b6c04d0018ff974bb6bbd344149044da5ae2d4f))
* update admin filament resource configuration ([d27d695](https://github.com/rectitude-open/filapress-core/commit/d27d695e6462d7b4386415b29c3c3cc9c04602c1))

## [1.1.0](https://github.com/rectitude-open/filapress-core/compare/v1.0.0...v1.1.0) (2025-05-14)


### Features

* add filament news ([b7f0933](https://github.com/rectitude-open/filapress-core/commit/b7f093390a71216b4a46a4152448baca08e2f534))
* add FilaPressCorePlugin class and update filaments version in composer.json ([23878f5](https://github.com/rectitude-open/filapress-core/commit/23878f5076900b1f0ecb94d16d1ea2da04e54ffe))
* add Login page ([904191e](https://github.com/rectitude-open/filapress-core/commit/904191e9fbd5ffe80a40b78552159b9d35a9dbfa))
* add user/audit feature ([10fbe9f](https://github.com/rectitude-open/filapress-core/commit/10fbe9f582c11f2fedf04db3c9ed555403955ead))
* update admin path configuration and improve FilaPressCorePlugin registration ([88b164d](https://github.com/rectitude-open/filapress-core/commit/88b164d9eed1579e58d1788b527d7b552f273870))

## 1.0.0 (2025-05-10)


### Features

* add necessary packages ([2c376df](https://github.com/rectitude-open/filapress-core/commit/2c376df40ac0e89f74b3fcbedd911cd2daa5551c))
* implement base classes for record management ([c4b55c4](https://github.com/rectitude-open/filapress-core/commit/c4b55c4008f994616dfa71cb5f517e45f8d8bde3))
* init package name and dev files ([62f9a8d](https://github.com/rectitude-open/filapress-core/commit/62f9a8ddbf3001273c5c646e440154d5a5d48483))
* replace php artisan test with pest in CI script ([be0ca70](https://github.com/rectitude-open/filapress-core/commit/be0ca703525c6ea74f7b0a82fdf12c70829759fd))
* update Laravel version from 10.* to 11.* in CI workflow ([2bdfc88](https://github.com/rectitude-open/filapress-core/commit/2bdfc8832cb1edc53c4e46f096af49c70d87e0a0))
* update PHP version matrix to include 8.3 and 8.4 ([75b6dc7](https://github.com/rectitude-open/filapress-core/commit/75b6dc75311ed403fb5d51978b446c5bc7d88c83))
* update testbench and carbon versions in CI workflow ([2861acc](https://github.com/rectitude-open/filapress-core/commit/2861accaa5adc917e8a0c413db6a24d1770d594a))


### Bug Fixes

* downgrade PHP requirement from 8.3 to 8.2 in composer.json ([8632a98](https://github.com/rectitude-open/filapress-core/commit/8632a98285967f06416d20a59fef45300a800283))

## Changelog

All notable changes to `filapress-core` will be documented in this file.
