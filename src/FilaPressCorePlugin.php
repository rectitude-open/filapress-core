<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore;

use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Contracts\Plugin;
use Filament\FontProviders\LocalFontProvider;
use Filament\Forms\Components\DateTimePicker;
use Filament\Navigation\NavigationGroup;
use Filament\Notifications\Livewire\Notifications;
use Filament\Panel;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Alignment;
use Filament\Tables\Columns\TextColumn;
use Hasnayeen\Themes\Http\Middleware\SetTheme;
use Hasnayeen\Themes\ThemesPlugin;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use MarcoGermani87\FilamentCaptcha\FilamentCaptcha;
use Mchev\Banhammer\Middleware\IPBanned;
use RectitudeOpen\FilamentBanManager\FilamentBanManagerPlugin;
use RectitudeOpen\FilamentBanManager\Models\Ban;
use RectitudeOpen\FilamentContactLogs\FilamentContactLogsPlugin;
use RectitudeOpen\FilamentContactLogs\Models\ContactLog;
use RectitudeOpen\FilamentInfoPages\FilamentInfoPagesPlugin;
use RectitudeOpen\FilamentInfoPages\Models\Page;
use RectitudeOpen\FilamentNews\FilamentNewsPlugin;
use RectitudeOpen\FilamentNews\Models\News;
use RectitudeOpen\FilamentSiteNavigation\FilamentSiteNavigationPlugin;
use RectitudeOpen\FilamentSiteNavigation\Models\SiteNavigation;
use RectitudeOpen\FilamentSiteSnippets\FilamentSiteSnippetsPlugin;
use RectitudeOpen\FilamentSiteSnippets\Models\SiteSnippet;
use RectitudeOpen\FilamentSystemSettings\FilamentSystemSettingsPlugin;
use RectitudeOpen\FilamentSystemSettings\Settings\SystemSettings;
use RectitudeOpen\FilaPressCore\Filament\Pages\Auth\Login;
use RectitudeOpen\FilaPressCore\Filament\Resources\AdminResource;
use RectitudeOpen\FilaPressCore\Models\Admin;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;
use Tapp\FilamentMailLog\FilamentMailLogPlugin;
use Tapp\FilamentMailLog\Models\MailLog;
use TomatoPHP\FilamentMediaManager\FilamentMediaManagerPlugin;
use TomatoPHP\FilamentMediaManager\Models\Folder;
use TomatoPHP\FilamentMediaManager\Models\Media;
use TomatoPHP\FilamentUsers\FilamentUsersPlugin;

class FilaPressCorePlugin implements Plugin
{
    public function getId(): string
    {
        return 'filapress-core';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->colors([
                'primary' => Color::Amber,
            ])
            ->authGuard('admin')
            ->brandName(fn () => config('filament-system-settings.system_settings', SystemSettings::class)::getSiteName())
            ->brandLogo(fn () => config('filament-system-settings.system_settings', SystemSettings::class)::getLogoUrl())
            ->favicon(fn () => config('filament-system-settings.system_settings', SystemSettings::class)::getFaviconUrl())
            ->path('admin-'.config('filapress-core.admin_path', 'admin'))
            ->login(Login::class)
            ->font(
                'Inter',
                url: asset('/admin-assets/'.config('filapress-core.admin_path', 'admin').'/css/fonts.css'),
                provider: LocalFontProvider::class,
            )
            ->middleware([
                IPBanned::class,
                SetTheme::class,
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label(__('menu.nav_group.content')),
                NavigationGroup::make()
                    ->label(__('menu.nav_group.security'))
                    ->collapsed(),
                NavigationGroup::make()
                    ->label(__('menu.nav_group.settings'))
                    ->collapsed(),
            ])
            ->resources([
                config('filapress-core.admin_filament_resource', AdminResource::class),
                \RectitudeOpen\FilaPressCore\Filament\Resources\MailLogResource::class,
                config('filament-logger.activity_resource'),
            ])
            ->plugins([
                ThemesPlugin::make(),
                FilamentCaptcha::make(),
                FilamentShieldPlugin::make(),
                FilamentUsersPlugin::make(),
                FilamentNewsPlugin::make(),
                FilamentBanManagerPlugin::make(),
                FilamentMailLogPlugin::make(),
                FilamentInfoPagesPlugin::make(),
                FilamentSystemSettingsPlugin::make(),
                FilamentContactLogsPlugin::make(),
                FilamentSiteNavigationPlugin::make(),
                FilamentSiteSnippetsPlugin::make(),
                FilamentMediaManagerPlugin::make(),
            ]);
    }

    public function boot(Panel $panel): void
    {
        Livewire::setScriptRoute(function ($handle) {
            return Route::get('/admin-assets/'.config('filapress-core.admin_path', 'admin').'/livewire/livewire.js', $handle);
        });

        DateTimePicker::configureUsing(function (DateTimePicker $component): void {
            $component->format('Y-m-d H:i:s');
            $component->displayFormat('Y-m-d H:i:s');
        });

        TextColumn::configureUsing(function (TextColumn $component): void {
            if (in_array($component->getName(), ['created_at', 'updated_at', 'published_at', 'email_verified_at'])) {
                $component->dateTime('Y-m-d H:i:s');
            }
        });

        Notifications::alignment(Alignment::Center);

        Gate::policy(Admin::class, Policies\AdminPolicy::class);
        Gate::policy(Role::class, Policies\RolePolicy::class);
        Gate::policy(News::class, Policies\NewsPolicy::class);
        Gate::policy(Ban::class, Policies\BanPolicy::class);
        Gate::policy(MailLog::class, Policies\MailLogPolicy::class);
        Gate::policy(Activity::class, Policies\ActivityPolicy::class);
        Gate::policy(Page::class, Policies\PagePolicy::class);
        Gate::policy(ContactLog::class, Policies\ContactLogPolicy::class);
        Gate::policy(SiteNavigation::class, Policies\SiteNavigationPolicy::class);
        Gate::policy(SiteSnippet::class, Policies\SiteSnippetPolicy::class);
        Gate::policy(Folder::class, Policies\FolderPolicy::class);
        Gate::policy(Media::class, Policies\MediaPolicy::class);
    }

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
