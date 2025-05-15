@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white rounded-lg shadow p-8 mt-8">
    <h1 class="text-2xl font-bold mb-6">My Cart</h1>
    @if(count($cartItems) > 0)
        <table class="min-w-full mb-6">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="py-2 px-4 w-42">Product</th>
                    <th class="py-2 px-4 w-42">Type</th>
                    <th class="py-2 px-4">Price</th>
                    <th class="py-2 px-4">Quantity</th>
                    <th class="py-2 px-4">Total</th>
                    <th class="py-2 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                <tr class="border-b">
                    <td class="py-2 px-4 w-full">{{ $item['product']['name'] ?? 'N/A' }}</td>
                    <td class="py-2 px-4 w-full">{{ $item['product']['type'] ?? 'N/A' }}</td>
                    <td class="py-2 px-4">₹{{ number_format($item['product']['price'] ?? 0, 2) }}</td>
                    <td class="py-2 px-4">
                    <form method="post" action="{{route('cartitems.update',$item['id'])}}">
                    <div class="flex gap-3">
                    @csrf
                    @method('PUT')
                    <input type="number" name='quantity' value="{{$item['quantity']}}" min="1" class="w-20" required/>
                    <button class="px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600" type="submit" >update</button>
                    </div>
                    </form>
                    </td>
                    <td class="py-2 px-4">₹{{ number_format(($item['product']['price'] ?? 0) * $item['quantity'], 2) }}</td>
                    <td class="py-2 px-4">
                        <form action="{{ route('cartitems.destroy', $item['id']) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex justify-end">
            <span class="text-xl font-semibold">
                Total: ₹{{ number_format(collect($cartItems)->sum(fn($item) => ($item['product']['price'] ?? 0) * $item['quantity']), 2) }}
            </span>
        </div>
        <div class="flex justify-end mt-4">

            <a href="/orders" class="px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600">Proceed to Checkout</a>
        </div>
    @else
        <p class="text-gray-600 text-center">Your cart is empty.</p>
    @endif
</div>
@endsection