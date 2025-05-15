<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,product_id']
        ]);


        $cart_id = $this->getCartId();

        if (!$this->handleExistingItem($cart_id, $validated['product_id'])) {
            CartItem::create([...$validated, 'quantity' => 1, 'cart_id' => $cart_id]);
        }

        return back();
    }

    protected function handleExistingItem(int $cartId, int $product_id): bool
    {
        $cart_item = CartItem::where('cart_id', $cartId)->where('product_id', $product_id)->first();;
        if ($cart_item) {
            $cart_item->increment('quantity');
            return true;
        }
        return false;
    }

    protected function getCartId()
    {

        $userCart = Auth::user()->cart;
        if (!$userCart) {

            $cart = Cart::create([
                'user_id' => Auth::id()
            ]);
            return $cart->cart_id;
        }

        return $userCart->cart_id;
    }

    public function update(string $id, Request $request)
    {
        $cartItem = CartItem::with('cart')->findOrFail($id);
        if ($cartItem['cart']['user_id'] !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'quantity' => ['integer', 'required']
        ]);


        $cartItem->update(['quantity' => $validated['quantity']]);
        return back();
    }

    public function destroy(string $id)
    {
        //validate user cart id here
        CartItem::findOrFail($id)->delete();
        return back();
    }
}
