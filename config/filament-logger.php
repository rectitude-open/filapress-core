<?php

declare(strict_types=1);

use Z3d0X\FilamentLogger\Loggers\AccessLogger;
use Z3d0X\FilamentLogger\Loggers\ModelLogger;
use Z3d0X\FilamentLogger\Loggers\NotificationLogger;
use Z3d0X\FilamentLogger\Loggers\ResourceLogger;
use Z3d0X\FilamentLogger\Resources\ActivityResource;

return [
    'datetime_format' => 'Y-m-d H:i:s',
    'date_format' => 'Y-m-d',

    'activity_resource' => ActivityResource::class,
    'scoped_to_tenant' => true,
    'navigation_sort' => 99,

    'resources' => [
        'enabled' => true,
        'log_name' => 'Resource',
        'logger' => ResourceLogger::class,
        'color' => 'success',

        'exclude' => [
            // App\Filament\Resources\UserResource::class,
        ],
        'cluster' => null,
        'navigation_group' => 'Security',
    ],

    'access' => [
        'enabled' => true,
        'logger' => AccessLogger::class,
        'color' => 'danger',
        'log_name' => 'Access',
    ],

    'notifications' => [
        'enabled' => true,
        'logger' => NotificationLogger::class,
        'color' => null,
        'log_name' => 'Notification',
    ],

    'models' => [
        'enabled' => true,
        'log_name' => 'Model',
        'color' => 'warning',
        'logger' => ModelLogger::class,
        'register' => [
            RectitudeOpen\FilamentSiteNavigation\Models\SiteNavigation::class,
            RectitudeOpen\FilamentNews\Models\NewsCategory::class,
        ],
    ],

    'custom' => [
        // [
        //     'log_name' => 'Custom',
        //     'color' => 'primary',
        // ]
    ],
];
