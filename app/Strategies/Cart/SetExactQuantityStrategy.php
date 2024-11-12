<?php

namespace App\Strategies\Cart;

use App\Dtos\NewCartItem;
use App\Models\CartItem;
use App\Strategies\Cart\Interfaces\CartAdjustmentStrategyInterface;
use App\Strategies\Cart\Interfaces\CartItemQuantityInterface;

class SetExactQuantityStrategy implements CartAdjustmentStrategyInterface, CartItemQuantityInterface
{
    public function upsert(NewCartItem $newCartItem, int $userId)
    {
        $cartItem = $this->getExistsItem($newCartItem->productId, $userId);

        $newQuantity = $newCartItem->quantity;
        $cartItem->quantity = $newQuantity;
        $cartItem->save();
    }

    public function isSatisfiedBy(int $desiredQuantity, ?int $currentQuantity, ?int $maxQuantity): bool
    {
        return $currentQuantity <= $maxQuantity;
    }

    private function getExistsItem(int $productId, int $userId): CartItem
    {
        $cartItem = CartItem::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        return $cartItem;
    }
}
