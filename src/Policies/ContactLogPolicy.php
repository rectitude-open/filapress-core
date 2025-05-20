<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Policies;

use RectitudeOpen\FilamentContactLogs\Models\ContactLog;
use RectitudeOpen\FilaPressCore\Models\Admin;

class ContactLogPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('view_any_contact::log');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, ContactLog $contactLog): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('view_contact::log');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('create_contact::log');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, ContactLog $contactLog): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('update_contact::log');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, ContactLog $contactLog): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('delete_contact::log');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, ContactLog $contactLog): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('restore_contact::log');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, ContactLog $contactLog): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('force_delete_contact::log');
    }
}
