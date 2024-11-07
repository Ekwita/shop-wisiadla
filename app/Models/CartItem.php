<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CartItem extends Model
{
    protected $fillable = [
        'product_id',
        'order_id',
        'value'
    ];

    public function product(): HasOne
    {
        return $this->hasOne(Product::class);
    }
}
