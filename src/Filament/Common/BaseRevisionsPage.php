<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Filament\Common;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Facades\Filament;
use Filament\Pages\Actions\Action;
use Illuminate\Support\Js;
use Illuminate\Support\Str;
use Mansoor\FilamentVersionable\RevisionsPage;

class BaseRevisionsPage extends RevisionsPage
{
    use HasPageShield;

    protected function getActions(): array
    {
        return [
            Action::make('cancel')
                ->color('gray')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.cancel.label'))
                ->alpineClickHandler('document.referrer ? window.history.back() : (window.location.href = '.Js::from($this->previousUrl ?? static::getResource()::getUrl()).')')
                ->icon('heroicon-o-arrow-left')
                ->label(__('action.back')),
        ];
    }

    public static function canAccess(array $parameters = []): bool
    {
        $admin = Filament::auth()->user();

        // @phpstan-ignore-next-line
        return $admin->hasRole('super-admin') ||
                $admin->can('revisions_'.Str::of(static::getResource())
                    ->afterLast('Resources\\')
                    ->before('Resource')
                    ->replace('\\', '')
                    ->snake());
    }
}
