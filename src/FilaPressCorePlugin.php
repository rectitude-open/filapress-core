<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore;

use Awcodes\Curator\CuratorPlugin;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Contracts\Plugin;
use Filament\FontProviders\LocalFontProvider;
use Filament\Navigation\NavigationGroup;
use Filament\Panel;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Colors\Color;
use Hasnayeen\Themes\Http\Middleware\SetTheme;
use Hasnayeen\Themes\ThemesPlugin;
use MarcoGermani87\FilamentCaptcha\FilamentCaptcha;
use Mchev\Banhammer\Middleware\IPBanned;
use RectitudeOpen\FilamentBanManager\FilamentBanManagerPlugin;
use RectitudeOpen\FilamentContactLogs\FilamentContactLogsPlugin;
use RectitudeOpen\FilamentInfoPages\FilamentInfoPagesPlugin;
use RectitudeOpen\FilamentLocalePicker\FilamentLocalePickerPlugin;
use RectitudeOpen\FilamentNews\FilamentNewsPlugin;
use RectitudeOpen\FilamentSiteNavigation\FilamentSiteNavigationPlugin;
use RectitudeOpen\FilamentSiteSnippets\FilamentSiteSnippetsPlugin;
use RectitudeOpen\FilamentSystemSettings\FilamentSystemSettingsPlugin;
use RectitudeOpen\FilamentSystemSettings\Settings\SystemSettings;
use RectitudeOpen\FilaPressCore\Filament\Pages\Auth\Login;
use RectitudeOpen\FilaPressCore\Filament\Resources\AdminResource;
use Tapp\FilamentMailLog\FilamentMailLogPlugin;
use TomatoPHP\FilamentUsers\FilamentUsersPlugin;

class FilaPressCorePlugin implements Plugin
{
    public function getId(): string
    {
        return 'filapress-core';
    }

    public function register(Panel $panel): void
    {
        $this->registerPlugins($panel);
    }

    public function registerPlugins(Panel $panel): void
    {

    }

    public function boot(Panel $panel): void {}

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
