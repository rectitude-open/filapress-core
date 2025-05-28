<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Filament\Resources;

use RectitudeOpen\FilamentNews\Filament\Resources\NewsResource as BaseNewsResource;
use RectitudeOpen\FilaPressCore\Filament\Resources\NewsResource\Pages;

class NewsResource extends BaseNewsResource
{
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
            'revisions' => Pages\NewsRevisions::route('/{record}/revisions'),
        ];
    }
}
