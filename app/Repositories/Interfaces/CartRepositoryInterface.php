<?php

namespace App\Repositories\Interfaces;

use App\Models\CartItem;

interface CartRepositoryInterface
{
    public function setNewQuantity(int $quantity, float $newValue, CartItem $cart): void;
    public function deleteSelectedItems(array $itemsList);
    public function deleteAllItems(int $userId);
}
