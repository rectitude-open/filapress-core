<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore;

use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Str;
use RectitudeOpen\FilaPressCore\Commands\FilaPressCoreCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Symfony\Component\Finder\Finder;

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

    public function boot()
    {
        parent::boot();

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadMigrationsFrom(__DIR__.'/../database/settings');

        FilamentView::registerRenderHook(
            PanelsRenderHook::GLOBAL_SEARCH_AFTER,
            fn () => view('filapress-core::components.admin.view-site-button'),
        );
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
