<?php

namespace App\Services;

use App\DataTransferObjects\CategoryDTO;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryService
{
    public function create(Request $request): CategoryDTO
    {
        /** @var User $owner */
        $owner = auth()->user();
        $category = $owner->categories()->create(
            CategoryDTO::from($request)->toArray()
        );

        return CategoryDTO::from($category->toArray());
    }

    public function delete(Category $category): bool
    {
        /** @var User $user */
        $user = auth()->user();
        if ($user->cannot('delete', $category)) {
            return false;
        }

        $category->delete();

        return true;
    }
}
