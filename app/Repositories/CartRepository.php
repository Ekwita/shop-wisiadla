<?php

namespace App\Repositories;

use App\Models\CartItem;
use App\Repositories\Interfaces\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{
    public function setNewQuantity(int $quantity, float $newValue, CartItem $cart): void
    {
        $cart->quantity = $quantity;
        $cart->value = $newValue;
        $cart->save();
    }
}
