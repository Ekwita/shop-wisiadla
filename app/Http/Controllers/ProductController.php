<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::paginate(3);

        return new JsonResponse($products);
    }

    public function show(Product $product)
    {
        return new JsonResponse($product);
    }

    public function store(Request $request)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
