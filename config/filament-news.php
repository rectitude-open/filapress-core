<?php

declare(strict_types=1);

return [
    'cluster' => [
        'navigation_sort' => 0,
        'navigation_icon' => 'heroicon-o-newspaper',
    ],
    'news' => [
        'navigation_sort' => 0,
        'navigation_icon' => 'heroicon-o-newspaper',
        'datetime_format' => 'Y-m-d H:i:s',
        'navigation_badge' => false,
        'model' => \RectitudeOpen\FilamentNews\Models\News::class,
        'filament_resource' => \RectitudeOpen\FilaPressCore\Filament\Resources\NewsResource::class,
    ],
    'news_category' => [
        'model' => \RectitudeOpen\FilamentNews\Models\NewsCategory::class,
        'page' => \RectitudeOpen\FilaPressCore\Filament\Pages\NewsCategory::class,
        'navigation_sort' => 2,
        'navigation_icon' => 'heroicon-o-rectangle-stack',
    ],
    'tag' => [
        'model' => \RectitudeOpen\FilamentNews\Models\Tag::class,
        'filament_resource' => \RectitudeOpen\FilaPressCore\Filament\Resources\NewsTagResource::class,
        'navigation_sort' => 3,
        'navigation_icon' => 'heroicon-o-tag',
    ],

    'editor_component_class' => \RectitudeOpen\FilamentTinyEditor6\TinyEditor::class,
];
