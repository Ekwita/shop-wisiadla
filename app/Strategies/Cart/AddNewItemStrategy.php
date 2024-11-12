<?php

namespace App\Strategies\Cart;

use App\Dtos\NewCartItem;
use App\Models\CartItem;
use App\Strategies\Cart\Interfaces\CartAdjustmentStrategyInterface;

class AddNewItemStrategy implements CartAdjustmentStrategyInterface
{

    public function upsert(NewCartItem $newCartItem)
    {
        $newValue = $newCartItem->quantity * $newCartItem->price;

        $newCartItem->value = $newValue;

        CartItem::create($newCartItem->toArray());
    }

    public function isSatisfiedBy(int $desiredQuantity, ?int $currentQuantity, ?int $maxQuantity): bool
    {
        return $currentQuantity === null;
    }
}
