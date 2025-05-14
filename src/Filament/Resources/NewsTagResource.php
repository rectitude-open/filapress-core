<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Filament\Resources;

use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Facades\Filament;
use RectitudeOpen\FilamentNews\Filament\Resources\NewsTagResource as BaseNewsTagResource;

class NewsTagResource extends BaseNewsTagResource implements HasShieldPermissions
{
    public static function getPermissionPrefixes(): array
    {
        return [
            'view_any_news_tags',
        ];
    }

    public static function canAccess(): bool
    {
        $admin = Filament::auth()->user();

        // @phpstan-ignore-next-line
        return $admin->hasRole('super-admin') || $admin->can('view_any_news_tags_news::tag');
    }
}
