<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Filament\Resources\PersonResource\Pages;

use RectitudeOpen\FilaPressCore\Filament\Common\BaseListRecords;
use RectitudeOpen\FilaPressCore\Filament\Resources\PersonResource;

class ListPeople extends BaseListRecords
{
    protected static string $resource = PersonResource::class;
}
