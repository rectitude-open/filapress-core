<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Filament\Resources;

use Tapp\FilamentMailLog\Resources\MailLogResource as BaseMailLogResource;

class MailLogResource extends BaseMailLogResource
{
    public static function getNavigationLabel(): string
    {
        return __('menu.nav_item.mail_log');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('menu.nav_group.security');
    }
}
