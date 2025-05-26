<?php

declare(strict_types=1);

return [
    'filament_resource' => RectitudeOpen\FilamentContactLogs\Resources\ContactLogResource::class,
    'model' => RectitudeOpen\FilamentContactLogs\Models\ContactLog::class,
    'navigation_sort' => 0,
    'navigation_icon' => 'heroicon-o-envelope-open',
    'datetime_format' => 'Y-m-d H:i:s',
    'navigation_badge' => true,
];
