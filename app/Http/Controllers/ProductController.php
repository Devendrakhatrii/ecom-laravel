<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('user')->where('user_id', '!=', Auth::id())->get();
        return view('product.index', ['products' => $products]);
    }

    public function create()
    {

        return view('product.create', ['product' => ""]);
    }

    public function userProduct()
    {

        if (Auth::check()) {
            $products = Auth::user()->products;
            return view('product.user-product', ['products' => $products]);
        }

        return redirect('/login');
    }

    public function store(Request $request)
    {
        if (Auth::check()) {
            $validated =   $request->validate(
                [
                    'name' => ['required', 'max:255'],
                    'description' => ['required', 'max:256'],
                    'price' => ['required', 'numeric', 'gt:0'],
                    'quantity' => ['required', 'numeric', 'gt:0'],
                    'type' => ['required', 'in:physical,digital'],
                ]

            );

            if (Product::create([...$validated, 'user_id' => Auth::id()])) {
                return redirect('/products')->with('success', 'Product created successfully!');;
            }
        }

        return redirect('/login');
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        if ($product) {

            $user = Auth::id() == $product->user_id ? true : null;

            return view('product.show', ['product' => $product, 'allowEdit' => $user]);
        }

        abort(404);
    }

    public function edit(string $id)
    {
        if (Auth::check()) {

            $product = Product::findOrFail($id);
            if ($product) {
                return view('product.create', ['product' => $product]);
            }
            abort(404);
        }

        return redirect('/login');
    }

    public function update(string $id, Request $request)
    {
        $validated = $request->validate([
            'name' => ['string', 'max:255'],
            'description' => ['string', 'max:255'],
            'price' => ['numeric', 'gt:0'],
            'quantity' => ['numeric', 'gt:0'],
            'type' => ['in:physical,digital']
        ]);


        if (Product::where('product_id', $id)->update(
            $validated
        )) {
            $product = Product::findOrFail($id);
            $user = Auth::id() == $product->user_id ? true : null;
            return view('product.show', ['product' => $product, 'allowEdit' => $user]);
        }
    }

    public function destroy(string $id)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $product = Product::findOrFail($id);

        if ($product->delete()) {
            return redirect('/products/user-product');
        }
    }
}
