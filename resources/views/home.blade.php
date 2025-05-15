
@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Home</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($products as $product)
        <div class="bg-white rounded-lg shadow p-6 flex flex-col">
            <h2 class="text-lg font-semibold mb-2">{{ $product['name'] }}</h2>
            <p class="text-gray-600 mb-2 line-clamp-2">{{ Str::limit($product['description'], 80) }}</p>
            <div class="mb-2">
                <span class="text-gray-700 font-semibold">Type:</span>
                <span class="text-gray-800">{{ ucfirst($product['type']) }}</span>
            </div>
            <div class="mb-4">
                <span class="text-gray-700 font-semibold">Price:</span>
                <span class="text-green-600 font-bold">₹{{ number_format($product['price'], 2) }}</span>
            </div>
            <form action="{{ route('cartitems.store') }}" method="POST" class="mt-auto">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product['product_id'] }}">
                <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Add to Cart</button>
            </form>
        </div>
        @empty
        <div class="col-span-3 text-center text-gray-500">No products available.</div>
        @endforelse
    </div>
</div>

@endsection
