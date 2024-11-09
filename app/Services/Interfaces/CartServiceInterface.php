<?php

namespace App\Services\Interfaces;

use App\Dtos\NewCartItem;

interface CartServiceInterface
{
    public function createCartItem(NewCartItem $newCartItem);
}
