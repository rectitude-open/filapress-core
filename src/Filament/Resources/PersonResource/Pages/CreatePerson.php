<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Filament\Resources\PersonResource\Pages;

use RectitudeOpen\FilaPressCore\Filament\Common\BaseCreateRecord;
use RectitudeOpen\FilaPressCore\Filament\Resources\PersonResource;

class CreatePerson extends BaseCreateRecord
{
    protected static string $resource = PersonResource::class;
}
