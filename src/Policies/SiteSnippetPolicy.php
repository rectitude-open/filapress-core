<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Policies;

use RectitudeOpen\FilamentSiteSnippets\Models\SiteSnippet;
use RectitudeOpen\FilaPressCore\Models\Admin;

class SiteSnippetPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('view_any_site::snippet');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, SiteSnippet $siteNavigation): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('view_site::snippet');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('create_site::snippet');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, SiteSnippet $siteNavigation): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('update_site::snippet');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, SiteSnippet $siteNavigation): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('delete_site::snippet');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, SiteSnippet $siteNavigation): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('restore_site::snippet');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, SiteSnippet $siteNavigation): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('force_delete_site::snippet');
    }
}
