<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('seller');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('seller');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): bool
    {
        return $user->hasRole('admin') ||
            ($user->hasRole('seller') && $user->id === $product->user_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): bool
    {
        return $user->hasRole('admin') ||
            ($user->hasRole('seller') && $user->id === $product->user_id);
    }

    public function view(User $user, Product $product)
    {
        return $user->hasRole('admin') ||
            ($user->hasRole('seller') && $user->id === $product->user_id);
    }
}
