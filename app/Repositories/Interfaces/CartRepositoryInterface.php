<?php

namespace App\Repositories\Interfaces;

use App\Dtos\NewCartItem;

interface CartRepositoryInterface
{
    public function create(NewCartItem $newCartItem);
    public function setMaxQuantity(NewCartItem $newCartItem);
    public function setNewQuantity(NewCartItem $newCartItem);
    public function increaseQuantity(NewCartItem $newCartItem);
    public function decreaseQuantity(NewCartItem $newCartItem);
}
