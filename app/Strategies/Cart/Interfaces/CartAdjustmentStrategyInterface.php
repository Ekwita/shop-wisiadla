<?php

namespace App\Strategies\Cart\Interfaces;

interface CartAdjustmentStrategyInterface
{
    public function isSatisfiedBy(int $desiredQuantity, ?int $currentQuantity, ?int $maxQuantity): bool;
}
