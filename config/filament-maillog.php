<?php

declare(strict_types=1);

return [
    'amazon-ses' => [
        'configuration-set' => null,
    ],

    'resources' => [
        'MaiLogResource' => RectitudeOpen\FilaPressCore\Filament\Resources\MailLogResource::class,
    ],

    'navigation' => [
        'maillog' => [
            'register' => true,
            'sort' => 98,
            'icon' => 'heroicon-o-envelope',
        ],
    ],

    'sort' => [
        'column' => 'created_at',
        'direction' => 'desc',
    ],
];
