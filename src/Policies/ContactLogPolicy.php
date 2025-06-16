<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Policies;

use RectitudeOpen\FilamentContactLogs\Models\ContactLog;
use RectitudeOpen\FilaPressCore\Models\Admin;

class ContactLogPolicy
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
        return $admin->can('view_any_contact::log');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, ContactLog $contactLog): bool
    {
        return $admin->can('view_contact::log');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->can('create_contact::log');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, ContactLog $contactLog): bool
    {
        return $admin->can('update_contact::log');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, ContactLog $contactLog): bool
    {
        return $admin->can('delete_contact::log');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, ContactLog $contactLog): bool
    {
        return $admin->can('restore_contact::log');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, ContactLog $contactLog): bool
    {
        return $admin->can('force_delete_contact::log');
    }
}
