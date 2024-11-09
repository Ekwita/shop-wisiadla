<?php

namespace App\Repositories\Interfaces;

use App\Dtos\NewCartItem;

interface ProductRepositoryInterface
{
    public function updateProductQuantity();
}