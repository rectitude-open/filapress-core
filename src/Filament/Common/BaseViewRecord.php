<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Filament\Common;

use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Js;

abstract class BaseViewRecord extends ViewRecord
{
    protected function getHeaderActions(): array
    {
        return [
            Action::make('cancel')
                ->label(__('filament-panels::resources/pages/create-record.form.actions.cancel.label'))
                ->alpineClickHandler('document.referrer ? window.history.back() : (window.location.href = '.Js::from($this->previousUrl ?? static::getResource()::getUrl()).')')
                ->color('gray')
                ->icon('heroicon-o-arrow-left')
                ->label(__('action.back')),
        ];
    }
}
