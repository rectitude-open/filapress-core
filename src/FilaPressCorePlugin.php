<?php

namespace RectitudeOpen\FilaPressCore;

use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Contracts\Plugin;
use Filament\FontProviders\LocalFontProvider;
use Filament\Forms\Components\DateTimePicker;
use Filament\Navigation\NavigationGroup;
use Filament\Notifications\Livewire\Notifications;
use Filament\Panel;
use Filament\Support\Enums\Alignment;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
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
use RectitudeOpen\FilamentSystemSettings\FilamentSystemSettingsPlugin;
use RectitudeOpen\FilamentSystemSettings\Settings\SystemSettings;
use RectitudeOpen\FilaPressCore\Filament\Pages\Auth\Login;
use RectitudeOpen\FilaPressCore\Filament\Resources\AdminResource;
use RectitudeOpen\FilaPressCore\Models\Admin;
use RectitudeOpen\FilaPressCore\Policies\ActivityPolicy;
use RectitudeOpen\FilaPressCore\Policies\AdminPolicy;
use RectitudeOpen\FilaPressCore\Policies\BanPolicy;
use RectitudeOpen\FilaPressCore\Policies\ContactLogPolicy;
use RectitudeOpen\FilaPressCore\Policies\MailLogPolicy;
use RectitudeOpen\FilaPressCore\Policies\NewsPolicy;
use RectitudeOpen\FilaPressCore\Policies\PagePolicy;
use RectitudeOpen\FilaPressCore\Policies\RolePolicy;
use RectitudeOpen\FilaPressCore\Policies\SiteNavigationPolicy;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;
use Tapp\FilamentMailLog\FilamentMailLogPlugin;
use Tapp\FilamentMailLog\Models\MailLog;
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
                FilamentShieldPlugin::make(),
                FilamentUsersPlugin::make(),
                FilamentNewsPlugin::make(),
                FilamentBanManagerPlugin::make(),
                FilamentMailLogPlugin::make(),
                FilamentInfoPagesPlugin::make(),
                FilamentSystemSettingsPlugin::make(),
                FilamentContactLogsPlugin::make(),
                FilamentSiteNavigationPlugin::make(),
            ])
            ->authGuard('admin');
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

        Gate::policy(Admin::class, AdminPolicy::class);
        Gate::policy(Role::class, RolePolicy::class);
        Gate::policy(News::class, NewsPolicy::class);
        Gate::policy(Ban::class, BanPolicy::class);
        Gate::policy(MailLog::class, MailLogPolicy::class);
        Gate::policy(Activity::class, ActivityPolicy::class);
        Gate::policy(Page::class, PagePolicy::class);
        Gate::policy(ContactLog::class, ContactLogPolicy::class);
        Gate::policy(SiteNavigation::class, SiteNavigationPolicy::class);
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
