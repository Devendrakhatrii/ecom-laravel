
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">My Products</h1>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="py-3 px-4 border-b">#</th>
                    <th class="py-3 px-4 border-b">Name</th>
                    <th class="py-3 px-4 border-b">Price</th>
                    <th class="py-3 px-4 border-b">Category</th>
                    <th class="py-3 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index => $product)
                <a href="/products/{{$product->product_id}}">
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                    <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                    <td class="py-2 px-4 border-b">₹{{ number_format($product->price, 2) }}</td>
                    <td class="py-2 px-4 border-b">{{ $product->type }}</td>
                    <td class="py-2 px-4 border-b flex space-x-2">
                        <a href="{{ route('products.edit', $product->product_id) }}" ><button class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">Edit</button></a>

                        <a href="{{ route('products.show', $product->product_id) }}" class="btn btn-primary"><button class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-sm">View</button></a>

                        <form action="{{ route('products.destroy', $product->product_id) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                </a>
                @empty
                <tr>
                    <td colspan="5" class="py-4 px-4 text-center text-gray-500">No products found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection