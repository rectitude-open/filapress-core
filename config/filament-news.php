<?php

return [
    'news_model' => RectitudeOpen\FilamentNews\Models\News::class,
    'news_category_model' => RectitudeOpen\FilamentNews\Models\NewsCategory::class,
    'tag_model' => RectitudeOpen\FilamentNews\Models\Tag::class,

    'news_category_page' => RectitudeOpen\FilaPressCore\Filament\Pages\NewsCategory::class,
    'news_filament_resource' => RectitudeOpen\FilamentNews\Filament\Resources\NewsResource::class,
    'news_tag_filament_resource' => RectitudeOpen\FilaPressCore\Filament\Resources\NewsTagResource::class,
];
