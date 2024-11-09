<?php

namespace App\Repositories\Interfaces;

use App\Dtos\NewCartItem;

interface CartRepositoryInterface
{
    public function create(NewCartItem $newCartItem);
}
