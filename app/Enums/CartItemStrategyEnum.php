<?php

namespace App\Enums;

use App\Strategies\Cart\AddNewItemStrategy;
use App\Strategies\Cart\Interfaces\CartAdjustmentStrategyInterface;
use App\Strategies\Cart\IncreaseWithinLimitStrategy;
use App\Strategies\Cart\LimitToMaxQuantityStrategy;

enum CartItemStrategyEnum: string
{
    case AddNewItem = AddNewItemStrategy::class;
    case LimitToMaxQuantity = LimitToMaxQuantityStrategy::class;
    case IncreaseWithinLimit = IncreaseWithinLimitStrategy::class;

    public function make(): CartAdjustmentStrategyInterface
    {
        return app($this->value);
    }
}
