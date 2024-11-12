<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(CreateOrderRequest $request)
    {
        $order = $request->getDto();
        Order::create($order->toArray());
    }
}
