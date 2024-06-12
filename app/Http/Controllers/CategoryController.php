<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\User;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function index()
    {
        //
    }

    public function store(CategoryRequest $request)
    {
        try {
            /** @var User $owner */
            $owner = auth()->user();
            $owner->categories()->create($request->validated());

            return response()->json(
                ['message' => 'category created successfully'],
                Response::HTTP_CREATED
            );
        } catch (Exception  $e) {
            return response()->json(
                ['message' => $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function show(string $id)
    {
        //
    }

    public function update(CategoryRequest $request, Category $category)
    {
        //
    }

    public function destroy(Category $category)
    {
        //
    }
}
