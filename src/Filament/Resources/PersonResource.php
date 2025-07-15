<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Filament\Resources;

use RectitudeOpen\FilamentPeople\Filament\Resources\PersonResource as BasePersonResource;
use RectitudeOpen\FilaPressCore\Filament\Resources\PersonResource\Pages;

class PersonResource extends BasePersonResource
{
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPeople::route('/'),
            'create' => Pages\CreatePerson::route('/create'),
            'edit' => Pages\EditPerson::route('/{record}/edit'),
            'revisions' => Pages\PeopleRevisions::route('/{record}/revisions'),
        ];
    }
}
