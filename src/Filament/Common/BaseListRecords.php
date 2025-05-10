<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Filament\Common;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class BaseListRecords extends ListRecords
{
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus'),
        ];
    }
}
