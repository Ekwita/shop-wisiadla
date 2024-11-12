<?php

namespace App\Repositories;

use App\Dtos\NewCartItem;
use App\Models\CartItem;
use App\Repositories\Interfaces\CartRepositoryInterface;

class CartRepository 
// implements CartRepositoryInterface
{
    // public function create(NewCartItem $newCartItem)
    // {
    //     CartItem::create($newCartItem->toArray());
    // }
    // public function setMaxQuantity(NewCartItem $newCartItem)
    // {
    //     $cartItem = $this->getExistsItem($newCartItem->productId);

    //     $cartItem->quantity = $cartItem->product->quantity;
    //     $cartItem->save();
    // }

    // public function setNewQuantity(NewCartItem $newCartItem)
    // {
    //     $cartItem = $this->getExistsItem($newCartItem->productId);

    //     $newQuantity = $newCartItem->quantity;
    //     $cartItem->quantity = $newQuantity;
    //     $cartItem->save();
    // }

    // public function increaseQuantity(NewCartItem $newCartItem)
    // {
    //     $cartItem = $this->getExistsItem($newCartItem->productId);

    //     $cartItem->quantity += $newCartItem->quantity;
    //     $cartItem->save();
    // }

    // public function decreaseQuantity(NewCartItem $newCartItem)
    // {
    //     $cartItem = $this->getExistsItem($newCartItem->productId);

    //     $cartItem->quantity -= $newCartItem->quantity;
    //     $cartItem->save();
    // }

    // private function getExistsItem(int $productId): CartItem
    // {
    //     $cartItem = CartItem::where('product_id', $productId)->first();

    //     return $cartItem;
    // }
}
