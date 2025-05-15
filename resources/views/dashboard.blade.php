@extends('layouts.app')

@section('content')
<div class="py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Cart Section -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Cart</h2>
            <p class="text-gray-600 mb-2">View and manage items in your cart.</p>
            <a href="{{route('carts.index')}}" class="inline-block mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Go to Cart</a>
        </div>
        <!-- My Products Section -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">My Products</h2>
            <p class="text-gray-600 mb-2">See and manage products you have listed.</p>
            <a href="/products/user-product" class="inline-block mt-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">View My Products</a>
        </div>
        <!-- All Products Section -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">All Products</h2>
            <p class="text-gray-600 mb-2">Browse all available products.</p>
            <a href="{{ route('products.index') }}" class="inline-block mt-2 px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">Browse Products</a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Add Product</h2>
            <p class="text-gray-600 mb-2">Add your available products.</p>
            <a href="{{ route('products.create') }}" class="inline-block mt-2 px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">Add Products</a>
        </div>
    </div>
</div>
@endsection