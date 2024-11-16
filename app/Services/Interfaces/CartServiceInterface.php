<?php

namespace App\Services\Interfaces;

use App\Dtos\NewCartItem;
use App\Models\CartItem;

interface CartServiceInterface
{
    public function upsertCartItem(NewCartItem $newCartItem);
    public function updateCartItem(int $quantity, CartItem $cart);
    public function deleteSelectedItems(array $itemsList);
    public function deleteAllItems();
}
