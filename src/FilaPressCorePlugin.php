<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore;

use Awcodes\Curator\CuratorPlugin;
use Awcodes\Curator\Models\Media;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Contracts\Plugin;
use Filament\FontProviders\LocalFontProvider;
use Filament\Forms\Components\DateTimePicker;
use Filament\Navigation\NavigationGroup;
use Filament\Notifications\Livewire\Notifications;
use Filament\Panel;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Alignment;
use Filament\Tables\Columns\TextColumn;
use Hasnayeen\Themes\Http\Middleware\SetTheme;
use Hasnayeen\Themes\ThemesPlugin;
use Illuminate\Support\Facades\Event;
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
use RectitudeOpen\FilaPressCore\Listeners\LogSavingSettings;
use RectitudeOpen\FilaPressCore\Listeners\LogSettingsSaved;
use RectitudeOpen\FilaPressCore\Models\Admin;
use Spatie\Activitylog\Models\Activity;
use Spatie\LaravelSettings\Events\SavingSettings;
use Spatie\LaravelSettings\Events\SettingsSaved;
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
                config('filament-logger.activity_resource'),
            ])
            ->plugins([
                ThemesPlugin::make(),
                FilamentCaptcha::make(),
                FilamentShieldPlugin::make(),
                FilamentUsersPlugin::make(),
                FilamentBanManagerPlugin::make(),
                FilamentSystemSettingsPlugin::make(),
                CuratorPlugin::make()
                    ->label('Media')
                    ->navigationIcon('heroicon-o-photo')
                    ->navigationGroup('Content')
                    ->navigationSort(100)
                    ->registerNavigation(true)
                    ->defaultListView('list'),
            ])
            ->assets([
                Css::make(
                    'curator-css',
                    asset('admin-assets/'.config('filapress-core.admin_path', 'admin').'/css/awcodes/curator/curator.css')
                ),
                Js::make(
                    'curator-js',
                    asset('admin-assets/'.config('filapress-core.admin_path', 'admin').'/js/awcodes/curator/components/curation.js')
                ),
            ]);

        $this->registerPlugins($panel);
    }

    public function registerPlugins(Panel $panel): void
    {
        if (config('filapress-core.plugins.FilamentNewsPlugin', true)) {
            $panel->plugins([FilamentNewsPlugin::make()]);
        }

        if (config('filapress-core.plugins.FilamentMailLogPlugin', true)) {
            $panel->plugins([FilamentMailLogPlugin::make()])
                ->resources([
                    \RectitudeOpen\FilaPressCore\Filament\Resources\MailLogResource::class,
                ]);
        }

        if (config('filapress-core.plugins.FilamentInfoPagesPlugin', true)) {
            $panel->plugins([FilamentInfoPagesPlugin::make()]);
        }

        if (config('filapress-core.plugins.FilamentContactLogsPlugin', true)) {
            $panel->plugins([FilamentContactLogsPlugin::make()]);
        }

        if (config('filapress-core.plugins.FilamentSiteSnippetsPlugin', true)) {
            $panel->plugins([FilamentSiteSnippetsPlugin::make()]);
        }

        if (config('filapress-core.plugins.FilamentSiteNavigationPlugin', true)) {
            $panel->plugins([FilamentSiteNavigationPlugin::make()]);
        }
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
        Gate::policy(Media::class, Policies\MediaPolicy::class);

        Event::listen(SavingSettings::class, LogSavingSettings::class);
        Event::listen(SettingsSaved::class, LogSettingsSaved::class);
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
