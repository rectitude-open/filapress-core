<?php

namespace RectitudeOpen\FilaPressCore;

use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Contracts\Plugin;
use Filament\FontProviders\LocalFontProvider;
use Filament\Forms\Components\DateTimePicker;
use Filament\Notifications\Livewire\Notifications;
use Filament\Panel;
use Filament\Support\Enums\Alignment;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use RectitudeOpen\FilamentNews\FilamentNewsPlugin;
use RectitudeOpen\FilamentNews\Models\News;
use RectitudeOpen\FilaPressCore\Filament\Pages\Auth\Login;
use RectitudeOpen\FilaPressCore\Filament\Resources\AdminResource;
use RectitudeOpen\FilaPressCore\Policies\NewsPolicy;
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
            ->path('admin-'.config('filapress-core.admin_path', 'admin'))
            ->login(Login::class)
            ->font(
                'Inter',
                url: asset('/admin-assets/'.config('filapress-core.admin_path', 'admin').'/css/fonts.css'),
                provider: LocalFontProvider::class,
            )
            ->resources([
                config('filament-ban-manager.filament_resource', AdminResource::class),
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
                FilamentUsersPlugin::make(),
                FilamentNewsPlugin::make(),
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

        Gate::policy(News::class, NewsPolicy::class);
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
