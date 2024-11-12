<?php

namespace App\Strategies\Cart;

use App\Dtos\NewCartItem;
use App\Models\CartItem;
use App\Strategies\Cart\Interfaces\CartAdjustmentStrategyInterface;
use App\Strategies\Cart\Interfaces\CartItemQuantityInterface;

class LimitToMaxQuantityStrategy  implements CartAdjustmentStrategyInterface, CartItemQuantityInterface
{

    public function upsert(NewCartItem $newCartItem, int $userId)
    {
        $cartItem = $this->getExistsItem($newCartItem->productId, $userId);

        $cartItem->quantity = $cartItem->product->quantity;
        $cartItem->value = $cartItem->product->price * $cartItem->product->quantity;

        $cartItem->save();
    }
    public function isSatisfiedBy(int $desiredQuantity, ?int $currentQuantity, ?int $maxQuantity): bool
    {
        return $desiredQuantity + $currentQuantity >= $maxQuantity;
    }

    private function getExistsItem(int $productId, int $userId): CartItem
    {
        $cartItem = CartItem::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        return $cartItem;
    }
}
