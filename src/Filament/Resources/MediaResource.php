<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Filament\Resources;

use Awcodes\Curator\Resources\MediaResource as CuratorMediaResource;

class MediaResource extends CuratorMediaResource
{
    public static function getNavigationLabel(): string
    {
        return __('filapress-core::filapress-core.navigation.item.media');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filapress-core::filapress-core.navigation.group.content');
    }

    public static function getModelLabel(): string
    {
        return __('filapress-core::filapress-core.navigation.item.media');
    }
}
