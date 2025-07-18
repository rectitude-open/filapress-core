<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Filament\Resources;

use RectitudeOpen\FilamentPhotos\Filament\Resources\PhotoResource as BasePhotoResource;
use RectitudeOpen\FilaPressCore\Filament\Resources\PhotoResource\Pages;

class PhotoResource extends BasePhotoResource
{
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPhotos::route('/'),
            'create' => Pages\CreatePhoto::route('/create'),
            'edit' => Pages\EditPhoto::route('/{record}/edit'),
        ];
    }
}
