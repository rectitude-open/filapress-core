<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Filament\Common;

use Filament\Actions;
use Filament\Actions\ActionGroup;
use Filament\Resources\Pages\EditRecord;
use Mansoor\FilamentVersionable\Page\RevisionsAction;

abstract class BaseEditRecord extends EditRecord
{
    protected function getRedirectUrl(): string
    {
        if ($this->previousUrl) {
            return $this->previousUrl;
        }

        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        $preActions = [];

        $resource = static::getResource();
        if ($resource::hasPage('revisions')) {
            $preActions[] = $this->getRevisionsAction();
        }

        return [
            ActionGroup::make([
                ...$preActions,
                Actions\DeleteAction::make()
                    ->icon('heroicon-o-trash'),
            ])
                ->label('More actions')
                ->icon('heroicon-m-ellipsis-vertical')
                ->color('gray')
                ->button(),
            $this->getBackAction(),
            $this->getSubmitAction(),
        ];
    }

    protected function getFormActions(): array
    {
        $postActions = [];

        $resource = static::getResource();
        if ($resource::hasPage('revisions')) {
            $postActions[] = $this->getRevisionsAction();
        }

        return [
            $this->getSubmitAction(),
            $this->getBackAction(),
            ActionGroup::make([
                ...$postActions,
                Actions\DeleteAction::make()
                    ->icon('heroicon-o-trash'),
            ])
                ->label('More actions')
                ->icon('heroicon-m-ellipsis-vertical')
                ->color('gray')
                ->button(),
        ];
    }

    protected function getBackAction(): Actions\Action
    {
        return $this->getCancelFormAction()
            ->icon('heroicon-o-arrow-left')
            ->label(__('action.back'));
    }

    protected function getSubmitAction(): Actions\Action
    {
        return $this->getSubmitFormAction()
            ->icon('heroicon-o-document-check')
            ->label(__('action.save'))
            ->formId('form');
    }

    protected function getRevisionsAction(): Actions\Action
    {
        return RevisionsAction::make()
            ->grouped()
            ->color('info')
            ->icon('heroicon-o-clock')
            ->label(__('action.revisions'));
    }
}
