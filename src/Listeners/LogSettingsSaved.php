<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Listeners;

use Spatie\LaravelSettings\Events\SettingsSaved;

class LogSettingsSaved
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
    public function handle(SettingsSaved $event): void
    {
        activity()
            ->withProperties([
                'ip' => request()->ip(),
                'settings' => $event->settings->toJson(),
            ])
            ->event('SettingsSaved')
            ->useLog('Model')
            ->log('Settings saved');
    }
}
