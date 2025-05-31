<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Filament\Resources;

use RectitudeOpen\FilamentInfoPages\Resources\PageResource as BasePageResource;
use RectitudeOpen\FilaPressCore\Filament\Resources\PageResource\Pages;

class PageResource extends BasePageResource
{
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
            'revisions' => Pages\PageRevisions::route('/{record}/revisions'),
        ];
    }
}
