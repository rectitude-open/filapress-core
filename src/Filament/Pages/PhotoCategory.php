<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Filament\Pages;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Facades\Filament;
use RectitudeOpen\FilamentPhotos\Filament\Pages\PhotoCategory as BasePhotoCategory;

class PhotoCategory extends BasePhotoCategory
{
    use HasPageShield;

    public static function canAccess(array $parameters = []): bool
    {
        $admin = Filament::auth()->user();

        // @phpstan-ignore-next-line
        return $admin->hasRole('super-admin') || $admin->can(static::getPermissionName());
    }
}
