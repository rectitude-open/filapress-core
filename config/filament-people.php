<?php

declare(strict_types=1);

return [
    'cluster' => [
        'navigation_sort' => 0,
        'navigation_icon' => 'heroicon-o-identification',
    ],
    'person' => [
        'navigation_sort' => 0,
        'navigation_icon' => 'heroicon-o-identification',
        'datetime_format' => 'Y-m-d H:i:s',
        'navigation_badge' => false,
        'model' => \RectitudeOpen\FilamentPeople\Models\Person::class,
        'filament_resource' => \RectitudeOpen\FilamentPeople\Filament\Resources\PersonResource::class,
    ],
    'person_category' => [
        'model' => \RectitudeOpen\FilamentPeople\Models\PersonCategory::class,
        'page' => \RectitudeOpen\FilamentPeople\Filament\Pages\PersonCategory::class,
        'navigation_sort' => 2,
        'navigation_icon' => 'heroicon-o-rectangle-stack',
    ],

    'editor_component_class' => \Filament\Forms\Components\RichEditor::class,
];
