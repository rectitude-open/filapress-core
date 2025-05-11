<?php

namespace RectitudeOpen\FilaPressCore;

use Filament\Contracts\Plugin;
use Filament\Forms\Components\DateTimePicker;
use Filament\Notifications\Livewire\Notifications;
use Filament\Panel;
use Filament\Support\Enums\Alignment;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

class FilaPressCorePlugin implements Plugin
{
    public function getId(): string
    {
        return 'filapress-core';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([]);
    }

    public function boot(Panel $panel): void
    {
        Livewire::setScriptRoute(function ($handle) {
            return Route::get('/admin-assets/'.config('admin.path').'/livewire/livewire.js', $handle);
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
