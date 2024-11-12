<?php

namespace App\Services;

use App\Dtos\NewCartItem;
use App\Factories\CartItemStrategiesFactory;
use App\Models\CartItem;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Services\Interfaces\CartServiceInterface;

class CartService implements CartServiceInterface
{
    public function __construct(
        protected CartItemStrategiesFactory $cartStrategiesFactory,
        protected CartRepositoryInterface $cartRepository
    ) {}

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


        $selectedStrategy = $this->cartStrategiesFactory->chooseStrategy($desiredQuantity, $currentQuantity, $maxQuantity);

        $setCartItemQuantity = $selectedStrategy->upsert($newCartItem, $userId);
    }

    public function updateCartItem(int $quantity, CartItem $cart)
    {
        $newValue = $cart->product->price * $quantity;
        $this->cartRepository->setNewQuantity($quantity, $newValue, $cart);
    }
}
