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
use RectitudeOpen\FilamentPeople\Models\Person;
use RectitudeOpen\FilamentPhotos\Models\Photo;
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
    }

    public function packageBooted(): void
    {

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
            ->name('filapress-core');
            // ->hasTranslations()
            // ->hasConfigFile([
            //     'audit',
            //     'ban',
            //     'filament-auditing',
            //     'filament-ban-manager',
            //     'filament-captcha',
            //     'filament-contact-logs',
            //     'filament-info-pages',
            //     'filament-logger',
            //     'filament-maillog',
            //     'filament-media-manager',
            //     'filament-news',
            //     'filament-shield',
            //     'filament-site-navigation',
            //     'filament-site-snippets',
            //     'filament-system-settings',
            //     'filament-tinyeditor',
            //     'filament-tree',
            //     'filament-users',
            //     'filament',
            //     'filapress-core',
            //     'livewire',
            //     'permission',
            //     'seo',
            //     'settings',
            //     'sluggable',
            //     'tags',
            //     'themes',
            //     'versionable',
            // ])
            // ->hasViews();
        // ->hasMigrations([]);

        // ->hasMigration('create_filapress_core_table')
        // ->hasCommand(FilaPressCoreCommand::class);
    }
}
