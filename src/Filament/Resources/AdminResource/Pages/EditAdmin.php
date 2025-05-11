<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Filament\Resources\AdminResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use RectitudeOpen\FilaPressCore\Filament\Resources\AdminResource;
use RectitudeOpen\FilaPressCore\Models\Admin;

class EditAdmin extends EditRecord
{
    protected static string $resource = AdminResource::class;

    public function mutateFormDataBeforeSave(array $data): array
    {
        $adminModel = config('filapress-core.admin_model', Admin::class);
        $getAdmin = $adminModel::where('email', $data['email'])->first();
        if ($getAdmin) {
            if (empty($data['password'])) {
                $data['password'] = $getAdmin->password;
            }
        }

        return $data;
    }

    protected function getActions(): array
    {
        // ! config('filament-users.impersonate') ?: $ret[] = Impersonate::make()->record($this->getRecord());
        $ret[] = DeleteAction::make();

        return $ret;
    }
}
