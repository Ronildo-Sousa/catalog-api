<?php

namespace App\Services;

use App\DataTransferObjects\CategoryDTO;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryService
{
    public function create(Request $request)
    {   
        /** @var User $owner */
        $owner = auth()->user();
        $owner->categories()->create(
            CategoryDTO::from($request)->toArray()
        );
    }
}