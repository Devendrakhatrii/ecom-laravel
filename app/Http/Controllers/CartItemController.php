<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartItemRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Models\CartItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartItemRequest $request)
    {
        $cart_item = $request->validated();
        $cartId = Cart::firstOrCreate(['user_id' => Auth::id()])->id;
        $cart_item['cart_id'] = $cartId;
        $existingCartItem = CartItem::with('product') // eager load related product
            ->where('cart_id', $cartId)
            ->where('product_id', $cart_item['product_id'])
            ->first();

        if ($existingCartItem) {
            $newQuantity = $existingCartItem->quantity + $cart_item['quantity'];
            if ($newQuantity > $existingCartItem->product->stock) {
                throw new \Exception('Not enough stock available.');
            }
            $existingCartItem->update([
                'quantity' => $newQuantity,
            ]);
        } else {
            CartItem::create($cart_item);
        }
        return redirect('/cart');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartItemRequest $request, CartItem $cartItem)
    {
        $attributes = $request->validated();
        $cartItem->update($attributes);
        return redirect('/cart');
    }

    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect('/cart');
    }
}
