<?php

declare(strict_types=1);

return [
    'admin_path' => env('ADMIN_PATH', 'admin'),
    'admin_model' => RectitudeOpen\FilaPressCore\Models\Admin::class,
    'admin_filament_resource' => RectitudeOpen\FilaPressCore\Filament\Resources\AdminResource::class,

    'plugins' => [
        'FilamentNewsPlugin' => true,
        'FilamentMailLogPlugin' => true,
        'FilamentInfoPagesPlugin' => true,
        'FilamentContactLogsPlugin' => true,
        'FilamentSiteSnippetsPlugin' => true,
        'FilamentSiteNavigationPlugin' => true,
    ],
];
