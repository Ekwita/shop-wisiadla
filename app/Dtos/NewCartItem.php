<?php

namespace App\Dtos;

class NewCartItem
{
    public function __construct(
        public int $productId,
        public ?int $userId,
        public int $quantity,
        public float $price,
        public ?float $value,
        public ?int $category
    ) {}

    public function toArray(): array
    {
        return [
            'product_id' => $this->productId,
            'user_id' => $this->userId,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'value' => $this->value,
            'category_id' => $this->category
        ];
    }
}
