<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Policies;

use RectitudeOpen\FilamentBanManager\Models\Ban;
use RectitudeOpen\FilaPressCore\Models\Admin;

class BanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('view_any_ban');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Ban $ban): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('view_ban');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('create_ban');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Ban $ban): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('update_ban');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Ban $ban): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('delete_ban');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, Ban $ban): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('restore_ban');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, Ban $ban): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('force_delete_ban');
    }
}
