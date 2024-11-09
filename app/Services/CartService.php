<?php

namespace App\Services;

use App\Dtos\NewCartItem;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Interfaces\CartServiceInterface;

class CartService implements CartServiceInterface
{
    public function __construct(
        protected CartRepositoryInterface $cartRepository,
    ) {}
    public function createCartItem(NewCartItem $newCartItem)
    {
        $newCartItem->value = $newCartItem->price * $newCartItem->quantity;
        $this->cartRepository->create($newCartItem);
    }
}
