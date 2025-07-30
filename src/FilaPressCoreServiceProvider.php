<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore;

use Awcodes\Curator\Models\Media;
use Filament\Forms\Components\DateTimePicker;
use Filament\Notifications\Livewire\Notifications;
use Filament\Support\Enums\Alignment;
use Filament\Support\Facades\FilamentView;
use Filament\Tables\Columns\TextColumn;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Livewire\Livewire;
use RectitudeOpen\FilamentBanManager\Models\Ban;
use RectitudeOpen\FilamentContactLogs\Models\ContactLog;
use RectitudeOpen\FilamentInfoPages\Models\Page;
use RectitudeOpen\FilamentNews\Models\News;
use RectitudeOpen\FilamentSiteNavigation\Models\SiteNavigation;
use RectitudeOpen\FilamentSiteSnippets\Models\SiteSnippet;
use RectitudeOpen\FilaPressCore\Commands\FilaPressCoreCommand;
use RectitudeOpen\FilaPressCore\Listeners\LogSavingSettings;
use RectitudeOpen\FilaPressCore\Listeners\LogSettingsSaved;
use RectitudeOpen\FilaPressCore\Models\Admin;
use Spatie\Activitylog\Models\Activity;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelSettings\Events\SavingSettings;
use Spatie\LaravelSettings\Events\SettingsSaved;
use Spatie\Permission\Models\Role;
use Symfony\Component\Finder\Finder;
use Tapp\FilamentMailLog\Models\MailLog;

class FilaPressCoreServiceProvider extends PackageServiceProvider
{
    public function register(): void
    {
        parent::register();
        $coreConfigs = static::getCoreConfigsToLoad();
        foreach ($coreConfigs as $key => $path) {
            $this->mergeConfigFrom($path, $key);
        }
    }

    public function packageBooted(): void
    {
        Livewire::setScriptRoute(function ($handle) {
            $prefix = trim(parse_url(config('app.url', ''), PHP_URL_PATH) ?? '', '/');
            $livewirePath = '/admin-assets/'.config('filapress-core.admin_path', 'admin').'/livewire/livewire.js';

            return Route::get($prefix ? '/'.$prefix.$livewirePath : $livewirePath, $handle);
        });

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadMigrationsFrom(__DIR__.'/../database/settings');

        FilamentView::registerRenderHook(
            PanelsRenderHook::GLOBAL_SEARCH_AFTER,
            // @phpstan-ignore-next-line
            fn () => view('filapress-core::components.admin.view-site-button'),
        );

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

    public static function getCoreConfigsToLoad(): array
    {
        $configs = [];
        $coreConfigPath = realpath(__DIR__.'/../config');

        if ($coreConfigPath && is_dir($coreConfigPath)) {
            $finder = new Finder;
            $configFiles = $finder->files()->in($coreConfigPath)->name('*.php');
            foreach ($configFiles as $file) {
                $key = Str::before($file->getFilename(), '.php');
                $configs[$key] = $file->getRealPath();
            }
        }

        return $configs;
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filapress-core')
            ->hasConfigFile([
                'audit',
                'ban',
                'filament-auditing',
                'filament-ban-manager',
                'filament-captcha',
                'filament-contact-logs',
                'filament-info-pages',
                'filament-logger',
                'filament-maillog',
                'filament-media-manager',
                'filament-news',
                'filament-shield',
                'filament-site-navigation',
                'filament-site-snippets',
                'filament-system-settings',
                'filament-tinyeditor',
                'filament-tree',
                'filament-users',
                'filament',
                'filapress-core',
                'livewire',
                'permission',
                'seo',
                'settings',
                'sluggable',
                'tags',
                'themes',
                'versionable',
            ])
            ->hasViews();
        // ->hasMigrations([]);

        // ->hasMigration('create_filapress_core_table')
        // ->hasCommand(FilaPressCoreCommand::class);
    }
}
