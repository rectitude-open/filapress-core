<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Policies;

use RectitudeOpen\FilaPressCore\Models\Admin;
use TomatoPHP\FilamentMediaManager\Models\Media;

class MediaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('view_any_media');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Media $media): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('view_media');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('create_media');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Media $media): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('update_media');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Media $media): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('delete_media');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, Media $media): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('restore_media');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, Media $media): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('force_delete_media');
    }
}
