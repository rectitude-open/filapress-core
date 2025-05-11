<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Filament\Resources\AdminResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use RectitudeOpen\FilaPressCore\Filament\Resources\AdminResource;

class ListAdmins extends ListRecords
{
    protected static string $resource = AdminResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
