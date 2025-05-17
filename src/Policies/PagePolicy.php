<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Policies;

use RectitudeOpen\FilamentInfoPages\Models\Page;
use RectitudeOpen\FilaPressCore\Models\Admin;

class PagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('view_any_page');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Page $page): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('view_page');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('create_page');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Page $page): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('update_page');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Page $page): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('delete_page');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, Page $page): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('restore_page');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, Page $page): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('force_delete_page');
    }
}
