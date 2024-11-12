<?php

namespace App\Services\Interfaces;

use App\Dtos\NewCartItem;
use App\Models\CartItem;

interface CartServiceInterface
{
    public function upsertCartItem(NewCartItem $newCartItem);
    public function updateCartItem(int $quantity, CartItem $cart);
}
