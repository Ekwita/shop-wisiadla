<?php

namespace App\Http\Requests;

use App\Dtos\NewCartItem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CartItemRequest extends FormRequest
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
            'product' => 'integer|min:0',
            'price' => 'decimal:2',
            'quantity' => 'integer|min:1',
            'category_id' => 'integer|nullable'
        ];
    }

    public function getDto(): NewCartItem
    {
        return new NewCartItem(
            $this->get('product'),
            $this->getUserId(),
            $this->get('quantity'),
            $this->get('price'),
            null,
            $this->get('category_id'),
        );
    }

    private function getUserId(): int
    {
        $user = auth()->user();
        return $user->id;
    }
}
