<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
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

    public function store(StoreProductRequest $request)
    {
        if (Auth::check()) {
            $validated =   $request->validated();

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

    public function update(string $id, UpdateProductRequest $request)
    {


        $validated = $request->validated();

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

        if ($product->product_id != Auth::id()) {
            abort(403, "un authorized access");
        }

        if ($product->delete()) {
            return redirect('/products/user-product');
        }
    }
}
