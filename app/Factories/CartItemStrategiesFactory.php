<?php

namespace App\Factories;

use App\Enums\CartItemStrategyEnum;
use App\Strategies\Cart\Interfaces\CartAdjustmentStrategyInterface;

class CartItemStrategiesFactory
{
    public function chooseStrategy(int $desiredQuantity, ?int $currentQuantity, ?int $maxQuantity): CartAdjustmentStrategyInterface
    {
        foreach (CartItemStrategyEnum::cases() as $strategy) {
            $cartItemStrategy = $strategy->make();
            if ($cartItemStrategy->isSatisfiedBy($desiredQuantity, $currentQuantity, $maxQuantity)) {
                return $cartItemStrategy;
            }
        }
    }
}
