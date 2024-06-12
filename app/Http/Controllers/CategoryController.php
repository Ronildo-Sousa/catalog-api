<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryService $service,
    ){}

    public function index()
    {
        //
    }

    public function store(CategoryRequest $request)
    {
        try {
            $category = $this->service->create($request);

            return response()->json(
                [
                    'message' => 'category created successfully',
                    'category' => $category,
                ],
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
        try {
            $deleted = $this->service->delete($category);
            if (!$deleted) {
                return response()->json(null, Response::HTTP_FORBIDDEN);    
            }

            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (Exception $e) {
            return response()->json(
                ['message' => $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
