<?php

namespace App\Http\Requests;

use App\Dtos\NewOrderDto;
use App\Enums\OrderStatus;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function getDto(): NewOrderDto
    {
        return new NewOrderDto(
            $this->getUserId(),
            $this->get('value'),
            OrderStatus::PendingPayment->value,
            null,
            false
        );
    }

    private function getUserId(): int
    {
        $user = auth()->user();
        $userId = $user->id;

        return $userId;
    }
}
