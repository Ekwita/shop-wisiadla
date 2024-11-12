<?php

namespace App\Strategies\Cart\Interfaces;

use App\Dtos\NewCartItem;

interface CartItemQuantityInterface
{
    public function upsert(NewCartItem $newCartItem, int $userId);
}
