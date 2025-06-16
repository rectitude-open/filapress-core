<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Policies;

use Awcodes\Curator\Models\Media;
use RectitudeOpen\FilaPressCore\Models\Admin;

class MediaPolicy
{
    public function before(Admin $admin, string $ability): ?bool
    {
        return $admin->hasRole('super-admin') ? true : null;
    }

    public function viewAny(Admin $admin): bool
    {
        return $admin->can('view_any_media');
    }

    public function create(Admin $admin): bool
    {
        return $admin->can('create_media');
    }

    public function update(Admin $admin, Media $media): bool
    {
        return $admin->can('update_media');
    }

    public function delete(Admin $admin, Media $media): bool
    {
        return $admin->can('delete_media');
    }

    public function deleteAny(Admin $admin): bool
    {
        return $admin->can('delete_any_media');
    }

    public function download(Admin $admin): bool
    {
        return $admin->can('download_any_media');
    }
}
