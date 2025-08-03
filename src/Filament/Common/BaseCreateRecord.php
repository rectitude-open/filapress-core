<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Filament\Common;

use Filament\Resources\Pages\CreateRecord;

abstract class BaseCreateRecord extends CreateRecord
{
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            $this->getCancelFormAction()
                ->icon('heroicon-o-arrow-left')
                ->label(__('action.back')),
            $this->getCreateAnotherFormAction()
                ->icon('heroicon-o-plus')
                ->label(__('action.create_another'))
                ->formId('form'),
            $this->getCreateFormAction()
                ->icon('heroicon-o-document-check')
                ->label(__('action.publish'))
                ->formId('form'),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->icon('heroicon-o-document-check')
                ->label(__('action.publish')),
            $this->getCreateAnotherFormAction()
                ->icon('heroicon-o-plus')
                ->label(__('action.create_another')),
            $this->getCancelFormAction()
                ->icon('heroicon-o-arrow-left')
                ->label(__('action.back')),
        ];
    }
}
