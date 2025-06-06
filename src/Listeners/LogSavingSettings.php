<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Listeners;

use Spatie\LaravelSettings\Events\SavingSettings;

class LogSavingSettings
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SavingSettings $event): void
    {
        activity()
            ->withProperties([
                'ip' => request()->ip(),
                'original_values' => $event->originalValues->diff($event->properties)->toJson(),
                'new_values' => $event->properties->diff($event->originalValues)->toJson(),
            ])
            ->event('SavingSettings')
            ->useLog('Model')
            ->log('Saving settings');
    }
}
