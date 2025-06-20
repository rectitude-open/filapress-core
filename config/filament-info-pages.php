<?php

declare(strict_types=1);

return [
    'filament_resource' => RectitudeOpen\FilaPressCore\Filament\Resources\PageResource::class,
    'model' => RectitudeOpen\FilamentInfoPages\Models\Page::class,
    'navigation_sort' => 0,
    'navigation_icon' => 'heroicon-o-document-text',
    'datetime_format' => 'Y-m-d H:i:s',
    'editor_component_class' => \RectitudeOpen\FilamentTinyEditor6\TinyEditor::class,
];
