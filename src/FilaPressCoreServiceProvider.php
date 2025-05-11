<?php

namespace RectitudeOpen\FilaPressCore;

use RectitudeOpen\FilaPressCore\Commands\FilaPressCoreCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilaPressCoreServiceProvider extends PackageServiceProvider
{
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
                'filapress-core',
                'auth',
                'audit',
                'filament-auditing',
                'filament-users',
            ])
            ->hasMigrations([]);
        // ->hasViews()
        // ->hasMigration('create_filapress_core_table')
        // ->hasCommand(FilaPressCoreCommand::class);
    }
}
