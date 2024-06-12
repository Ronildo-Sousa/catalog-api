<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    public function delete(User $user, Category $category): bool
    {
        return $user->id === $category->owner_id;
    }
}
