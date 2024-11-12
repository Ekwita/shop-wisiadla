<?php

namespace App\Strategies\Cart;

use App\Dtos\NewCartItem;
use App\Models\CartItem;
use App\Strategies\Cart\Interfaces\CartAdjustmentStrategyInterface;
use App\Strategies\Cart\Interfaces\CartItemQuantityInterface;

class IncreaseWithinLimitStrategy implements CartAdjustmentStrategyInterface, CartItemQuantityInterface
{
    public function upsert(NewCartItem $newCartItem, int $userId)
    {
        $cartItem = $this->getExistsItem($newCartItem->productId, $userId);

        $cartItem->quantity += $newCartItem->quantity;
        $cartItem->value = $cartItem->quantity * $cartItem->product->price;
        $cartItem->save();
    }

    public function isSatisfiedBy(int $desiredQuantity, ?int $currentQuantity, ?int $maxQuantity): bool
    {
        return $currentQuantity + $desiredQuantity <= $maxQuantity;
    }

    private function getExistsItem(int $productId, int $userId): CartItem
    {
        $cartItem = CartItem::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        return $cartItem;
    }
}
