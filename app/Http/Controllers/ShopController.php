<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Inertia\Inertia;
use Inertia\Response;

class ShopController extends Controller
{
    public function index(): Response
    {
        $products = Product::with('category')->get();
        $productsList = new ResourceCollection($products);

        return Inertia::render('Shop', [
            'products' => ProductResource::collection($productsList)
        ]);
    }
}
