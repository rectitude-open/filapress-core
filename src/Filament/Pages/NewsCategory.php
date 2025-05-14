<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Filament\Pages;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Facades\Filament;
use RectitudeOpen\FilamentNews\Filament\Pages\NewsCategory as BaseNewsCategory;

class NewsCategory extends BaseNewsCategory
{
    use HasPageShield;

    public static function canAccess(array $parameters = []): bool
    {
        $admin = Filament::auth()->user();

        // @phpstan-ignore-next-line
        return $admin->hasRole('super-admin') || $admin->can(static::getPermissionName());
    }
}
