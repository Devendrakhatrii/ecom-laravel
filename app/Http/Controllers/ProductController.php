<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('home', compact('products'));
    }

    public function myProducts()
    {
        $products = Product::where('user_id', Auth::id())->latest()->get();
        return view('myProducts', compact('products'));
    }

    public function othersProducts()
    {
        $products = Product::where('user_id', '!=', Auth::id())->latest()->get();
        return view('othersProducts', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('createProduct');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = $request->validated();
        $product['user_id'] = Auth::id();
        Product::create($product);
        return redirect('/home');
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $isMyProduct = Auth::id() === $product->user_id;
        return view('productDetail', compact('isMyProduct', 'product'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('editProduct', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $attributes = $request->validated();

        $product->update($attributes);
        return redirect("/product/{$product->id}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect("/home");
    }
}
