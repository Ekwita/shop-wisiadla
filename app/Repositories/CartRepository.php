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

    public function deleteSelectedItems(array $itemsList)
    {
        foreach ($itemsList as $item) {
            CartItem::where('id', $item['id'])->delete();
        }
    }

    public function deleteAllItems(int $userId)
    {
        CartItem::where('user_id', $userId)->delete();
    }
}
