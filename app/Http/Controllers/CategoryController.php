<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\CategoryDTO;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryService $service,
    ) {
    }

    public function index()
    {
        return response()->json(
            $this->service->list(),
            Response::HTTP_OK
        );
    }

    public function store(CategoryRequest $request)
    {
        try {
            $category = $this->service->create($request->validated());

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

    public function show(Category $category)
    {
        return response()->json(
            $this->service->show($category),
            Response::HTTP_OK
        );
    }

    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $category = $this->service->update($request->validated(), $category);
            if (!$category) {
                return response()->json(null, Response::HTTP_FORBIDDEN);
            }

            return response()->json(
                ['message' => 'category updated successfully'],
                Response::HTTP_NO_CONTENT
            );
        } catch (Exception  $e) {
            return response()->json(
                ['message' => $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
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
