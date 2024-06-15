<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductService
{
    public const PRODUCTS_PER_PAGE = 5;

    public function list(int $per_page = self::PRODUCTS_PER_PAGE)
    {
        return ProductResource::collection(
            Product::query()
                ->where('owner_id', '=', auth()->id())
                ->paginate($per_page)
        );    
    }
}