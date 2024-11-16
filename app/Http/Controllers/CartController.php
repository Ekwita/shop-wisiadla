<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemRequest;
use App\Models\CartItem;
use App\Services\Interfaces\CartServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class CartController extends Controller
{

    public function __construct(protected CartServiceInterface $cartService) {}
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $user = Auth::user();
        $cartItems = CartItem::with('product')->where('user_id', $user->id)->get();

        return Inertia::render('Cart/Cart', [
            'cartItems' => $cartItems,
            'canLogin' => Route::has('login'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CartItemRequest $request)
    {
        $cartItem = $request->getDto();
        $this->cartService->upsertCartItem($cartItem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CartItemRequest $request, CartItem $cart)
    {
        $newQuantity = $request->quantity;
        $this->cartService->updateCartItem($newQuantity, $cart);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartItem $cart)
    {
        $cart->delete();
    }

    public function destroySelected(Request $request)
    {
        $itemsList = $request->cartItems;

        $this->cartService->deleteSelectedItems($itemsList);
    }

    public function destroyAll()
    {
        $this->cartService->deleteAllItems();       
    }
}
