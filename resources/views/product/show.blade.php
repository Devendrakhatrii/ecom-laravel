@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-8 mt-8">
    <h1 class="text-2xl font-bold mb-4">{{ $product->name }}</h1>
    <div class="mb-4">
        <span class="text-gray-700 font-semibold">Price:</span>
        <span class="text-lg text-green-600 font-bold">₹{{ number_format($product->price, 2) }}</span>
    </div>
    <div class="mb-4">
        <span class="text-gray-700 font-semibold">Category:</span>
        <span class="text-gray-800">{{ $product->type }}</span>
    </div>
    <div class="mb-6">
        <span class="text-gray-700 font-semibold">Description:</span>
        <p class="text-gray-600 mt-1">{{ $product->description ?? 'No description available.' }}</p>
    </div>
    @if($allowEdit)
    <div class="flex space-x-4">
        <a href="{{ route('products.edit',  $product->product_id) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</a>
        <form action="{{ route('products.destroy', $product->product_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
        </form>
    </div>
    @endif
</div>
@endsection