<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Policies;

use RectitudeOpen\FilamentNews\Models\News;
use RectitudeOpen\FilaPressCore\Models\Admin;

class NewsPolicy
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
        return $admin->can('view_any_news');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, News $news): bool
    {
        return $admin->can('view_news');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->can('create_news');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, News $news): bool
    {
        return $admin->can('update_news');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, News $news): bool
    {
        return $admin->can('delete_news');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, News $news): bool
    {
        return $admin->can('restore_news');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, News $news): bool
    {
        return $admin->can('force_delete_news');
    }
}
