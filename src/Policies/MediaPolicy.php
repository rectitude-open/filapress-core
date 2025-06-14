<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Policies;

use Awcodes\Curator\Models\Media;
use RectitudeOpen\FilaPressCore\Models\Admin;

class MediaPolicy
{
    public function viewAny(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('view_any_media');
    }

    public function create(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('create_media');
    }

    public function update(Admin $admin, Media $media): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('update_media');
    }

    public function delete(Admin $admin, Media $media): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('delete_media');
    }

    public function deleteAny(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('delete_any_media');
    }

    public function download(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('download_any_media');
    }
}
