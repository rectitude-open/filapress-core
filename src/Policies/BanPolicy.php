<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Policies;

use RectitudeOpen\FilamentBanManager\Models\Ban;
use RectitudeOpen\FilaPressCore\Models\Admin;

class BanPolicy
{
    public function before(Admin $admin, string $ability): ?bool
    {
        return $admin->hasRole('super-admin') ? true : null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->can('view_any_ban');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Ban $ban): bool
    {
        return $admin->can('view_ban');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->can('create_ban');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Ban $ban): bool
    {
        return $admin->can('update_ban');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Ban $ban): bool
    {
        return $admin->can('delete_ban');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, Ban $ban): bool
    {
        return $admin->can('restore_ban');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, Ban $ban): bool
    {
        return $admin->can('force_delete_ban');
    }
}
