<?php

namespace App\Dtos;

use App\Enums\OrderStatus;

class NewOrderDto
{
    public function __construct(
        public int $userId,
        public float $value,
        public string $status = OrderStatus::PendingPayment->value,
        public ?string $paymentMethod,
        public bool $isPaid = false,
    ) {}

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'value' => $this->value,
            'status' => $this->status,
            'paymentMethod' => $this->paymentMethod,
            'isPaid' => $this->isPaid
        ];
    }
}
