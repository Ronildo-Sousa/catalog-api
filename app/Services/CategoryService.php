<?php

namespace App\Services;

use App\DataTransferObjects\CategoryDTO;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\User;

class CategoryService
{
    public const CATEGORIES_PER_PAGE = 5;

    public function list(int $per_page = self::CATEGORIES_PER_PAGE)
    {
        return CategoryResource::collection(
            Category::query()
                ->where('owner_id', '=', auth()->id())
                ->paginate($per_page)
        );
    }

    public function create(array $paylod): CategoryDTO
    {
        /** @var User $owner */
        $owner = auth()->user();
        $category = $owner->categories()->create(
            CategoryDTO::from($paylod)->toArray()
        );

        return CategoryDTO::from($category->toArray());
    }

    public function show(Category $category): CategoryDTO
    {
        return CategoryDTO::from($category->toArray());
    }

    public function update(array $paylod, Category $category): ?CategoryDTO
    {
        /** @var User $user */
        $user = auth()->user();
        if ($user->cannot('update', $category)) {
            return null;
        }

        $category->update($paylod);
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
