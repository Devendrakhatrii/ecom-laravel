<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $cart_items = CartItem::with('product')->where('cart_id', $cart->cart_id)->get();
        return view('cart.cart', ['cartItems' => $cart_items]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cart = Cart::create(['user_id' => Auth::id()]);

        return $cart;
    }
}
