<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use App\Services\ProductTypes\ProductFactory;
use App\Services\CartPricingService;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::firstorCreate(['user_id' => Auth::id()]);
        $cart_items = CartItem::with('product')->where('cart_id', $cart->id)->get();
        $total = 0;

        foreach ($cart_items as &$cartItem) {

            $productData = $cartItem->product->toArray();
            $productData['quantity']  = $cartItem->quantity;
            $product = ProductFactory::create($productData);
            $cartItem->total = $product->calculateTotal();
            $total += $product->calculateTotal();
        }
        return view('ViewCart', compact('cart', 'cart_items', 'total'));
    }

    public function checkout()
    {
        $cartId = Cart::where('user_id', Auth::id())->first()->id;
        $cart_items = CartItem::with('product')->where('cart_id', $cartId)->get();
        $pricing = CartPricingService::calculate($cart_items->toArray());

        $cart_items = $pricing['cartItems'];
        $totalPrice = $pricing['total'];
        $tax = $pricing['tax'];
        $grandTotal = $pricing['grandTotal'];
        $paymentMethods = $pricing['paymentMethods'];
        return view('checkout', compact('cart_items', 'totalPrice', 'tax', 'grandTotal', 'paymentMethods'));
    }
}
