<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Policies;

use RectitudeOpen\FilaPressCore\Models\Admin;
use TomatoPHP\FilamentMediaManager\Models\Folder;

class FolderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('view_any_folder');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Folder $folder): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('view_folder');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('create_folder');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Folder $folder): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('update_folder');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Folder $folder): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('delete_folder');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, Folder $folder): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('restore_folder');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, Folder $folder): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('force_delete_folder');
    }
}
