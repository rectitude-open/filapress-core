<?php

namespace RectitudeOpen\FilaPressCore;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use RectitudeOpen\FilaPressCore\Commands\FilaPressCoreCommand;

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
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_filapress_core_table')
            ->hasCommand(FilaPressCoreCommand::class);
    }
}
