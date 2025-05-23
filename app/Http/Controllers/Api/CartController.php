<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use ApiResponse;

    public function index(): JsonResponse
    {
        try {

            $cart = Auth::user()->cart()->with('cartItems.product')->first();

            if (!$cart) {
                return $this->fails('unable to get user cart', 400);
            }
            return $this->success($cart, 'user cart fetched succesfully');
        } catch (Exception $e) {
            return $this->fails('unable to get user cart', 500, $e->getMessage());
        }
    }

    public function store()
    {
        try {
            if (Auth::user()->cart) {
                return $this->fails('cart already exist for user', 403);
            }

            $cart = Cart::create(['user_id' => Auth::id()]);
            if (!$cart) {
                return $this->fails('Cart not created', 400);
            }

            return $this->success($cart, 'cart created successfully');
        } catch (Exception $e) {
            return $this->fails('unable to create cart', 500, $e->getMessage());
        }
    }

    public function addToCart(Request $request)
    {
        try {
            $cart = Auth::user()->cart;

            $added = CartItem::create([
                'cart_id' => $cart->cart_id,
                'product_id' => $request->product_id,
                'quantity' => 1
            ]);

            if (!$added) {
                return $this->fails('unable to add item to cart');
            }

            return $this->success('item added to cart succesfully');
        } catch (Exception $e) {
            return $this->fails('unable to add item to cart', 500, $e->getMessage());
        }
    }

    public function removeFromCart(Request $request)
    {
        try {

            $cart = Auth::user()->cart;
            $cart_item = CartItem::find($request->id);


            if ($cart->cart_id != $cart_item->cart_id) {
                return $this->fails('unable to remove item from cart', 403, 'unathorized access');
            }

            $deleted = $cart_item->delete();
            if (!$deleted) {
                return $this->fails('unable to remove item from cart');
            }

            return $this->success('item removed form cart');
        } catch (Exception $e) {
            return $this->fails('unable to remove item from cart', 500, $e->getMessage());
        }
    }

    public function updateQuantity(Request $request): JsonResponse
    {

        $validated = $request->validate([
            'cart_item_id' => ['required', 'exists:cart_items,id'],
            'quantity' => ['integer', 'gt:0']
        ]);

        $cart = Auth::user()->cart;
        $cartItem = $cart->cartItems()->where('id', $validated['cart_item_id'])->first();

        if ($cart->cart_id != $cartItem->cart_id) {
            return $this->fails('unauthorized access');
        }

        if (!$cartItem) {
            return $this->fails('Cart item not found', 404);
        }

        $cartItem->quantity = $validated['quantity'];
        $cartItem->save();

        return $this->success('Cart item quantity updated successfully');
    }
}
