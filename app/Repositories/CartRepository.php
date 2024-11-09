<?php

namespace App\Repositories;

use App\Dtos\NewCartItem;
use App\Models\CartItem;
use App\Repositories\Interfaces\CartRepositoryInterface;
use Illuminate\Http\JsonResponse;

class CartRepository implements CartRepositoryInterface
{
    public function create(NewCartItem $newCartItem)
    {
        CartItem::create($newCartItem->toArray());
    }
}
