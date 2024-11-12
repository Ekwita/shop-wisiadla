<?php

namespace App\Services;

use App\Dtos\NewCartItem;
use App\Enums\CartItemStrategyEnum;
use App\Models\CartItem;
use App\Services\Interfaces\CartServiceInterface;
use App\Strategies\Cart\Interfaces\CartAdjustmentStrategyInterface;

class CartService implements CartServiceInterface
{
    public function upsertCartItem(NewCartItem $newCartItem)
    {
        $user = auth()->user();
        $userId = $user->id;

        $desiredQuantity = $newCartItem->quantity;

        $cartItem = CartItem::where('user_id', $userId)
            ->where('product_id', $newCartItem->productId)
            ->first();

        $currentQuantity = $cartItem ? $cartItem->quantity : null;
        $maxQuantity = $cartItem ? $cartItem->product->quantity : null;

        $selectedStrategy = $this->chooseStrategy($desiredQuantity, $currentQuantity, $maxQuantity);

        $setCartItemQuantity = $selectedStrategy->upsert($newCartItem, $userId);
    }

    public function updateItem()
    {
        
    }

    private function chooseStrategy(int $desiredQuantity, ?int $currentQuantity, ?int $maxQuantity): CartAdjustmentStrategyInterface
    {
        foreach (CartItemStrategyEnum::cases() as $strategy) {
            $cartItemStrategy = $strategy->make();
            if ($cartItemStrategy->isSatisfiedBy($desiredQuantity, $currentQuantity, $maxQuantity)) {
                return $cartItemStrategy;
            }
        }
    }
}
