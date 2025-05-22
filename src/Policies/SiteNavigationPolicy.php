<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Policies;

use RectitudeOpen\FilamentSiteNavigation\Models\SiteNavigation;
use RectitudeOpen\FilaPressCore\Models\Admin;

class SiteNavigationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('view_any_site::navigation');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, SiteNavigation $siteNavigation): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('view_site::navigation');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('create_site::navigation');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, SiteNavigation $siteNavigation): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('update_site::navigation');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, SiteNavigation $siteNavigation): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('delete_site::navigation');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, SiteNavigation $siteNavigation): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('restore_site::navigation');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, SiteNavigation $siteNavigation): bool
    {
        return $admin->hasRole('super-admin') || $admin->can('force_delete_site::navigation');
    }
}
