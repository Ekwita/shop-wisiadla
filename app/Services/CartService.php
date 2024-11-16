<?php

namespace App\Services;

use App\Dtos\NewCartItem;
use App\Factories\CartItemStrategiesFactory;
use App\Models\CartItem;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Services\Interfaces\CartServiceInterface;
use Illuminate\Support\Facades\Auth;

class CartService implements CartServiceInterface
{
    public function __construct(
        protected CartItemStrategiesFactory $cartStrategiesFactory,
        protected CartRepositoryInterface $cartRepository
    ) {}

    public function upsertCartItem(NewCartItem $newCartItem)
    {
        $user = Auth::user();
        $userId = $user->id;

        $desiredQuantity = $newCartItem->quantity;

        $cartItem = CartItem::where('user_id', $userId)
            ->where('product_id', $newCartItem->productId)
            ->first();

        $currentQuantity = $cartItem ? $cartItem->quantity : null;
        $maxQuantity = $cartItem ? $cartItem->product->quantity : null;


        $selectedStrategy = $this->cartStrategiesFactory->chooseStrategy($desiredQuantity, $currentQuantity, $maxQuantity);

        $selectedStrategy->upsert($newCartItem, $userId);
    }

    public function updateCartItem(int $quantity, CartItem $cart)
    {
        $newValue = $cart->product->price * $quantity;
        $this->cartRepository->setNewQuantity($quantity, $newValue, $cart);
    }

    public function deleteSelectedItems(array $itemsList)
    {
        $this->cartRepository->deleteSelectedItems($itemsList);
    }

    public function deleteAllItems()
    {
        $user = Auth::user();
        $userId = $user->id;
        $this->cartRepository->deleteAllItems($userId);
    }
}
