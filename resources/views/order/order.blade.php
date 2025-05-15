{{-- filepath: /home/devendra/workspace/laravel/ecommerce/resources/views/order/order.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6">Place Your Order</h2>
    <form action="/orders" method="POST" class="space-y-8">
        @csrf

        <!-- Address Section -->
        <div>
            <h4 class="text-lg font-semibold mb-2">Shipping Address</h4>
            <textarea name="address" id="address" class="w-full border rounded p-2 focus:outline-none focus:ring focus:border-blue-300" required>{{ old('address') }}</textarea>
            <x-form-error name='address'/>
        </div>

        <!-- Payment Type Section -->
        <div>
            <h4 class="text-lg font-semibold mb-2">Payment Type</h4>
            <select name="payment_type" class="w-full border rounded p-2 focus:outline-none focus:ring focus:border-blue-300" required>
                <option value="">Select Payment Type</option>
                @foreach($payments as $method)
                    <option value="{{ $method }}">{{ ucfirst($method) }}</option>
                @endforeach
            </select>
            <x-form-error name='payment_type'/>
        </div>

        <!-- Cart Items Section -->
        <div>
            <h4 class="text-lg font-semibold mb-2">Your Cart</h4>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border rounded shadow">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border-b text-left">Product</th>
                            <th class="py-2 px-4 border-b text-left">Type</th>
                            <th class="py-2 px-4 border-b text-left">Quantity</th>
                            <th class="py-2 px-4 border-b text-left">Price</th>
                            <th class="py-2 px-4 border-b text-left">Discount</th>
                            <th class="py-2 px-4 border-b text-left">Shipping</th>
                            <th class="py-2 px-4 border-b text-left">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order as $item)
                            @if(is_array($item) && isset($item['product']))
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $item['product']->name ?? '-' }}</td>
                                <td class="py-2 px-4 border-b">{{ $item['product']->type ?? '-' }}</td>
                                <td class="py-2 px-4 border-b">{{ $item['quantity'] }}</td>
                                <td class="py-2 px-4 border-b">₹{{ number_format($item['price']) }}</td>
                                <td class="py-2 px-4 border-b">- ₹{{ number_format($item['discount']) }}</td>
                                <td class="py-2 px-4 border-b">+ ₹{{ number_format($item['shipping']) }}</td>
                                <td class="py-2 px-4 border-b">₹{{ number_format($item['item_total']) }}</td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-right mt-4">
                <div class="text-xl font-bold mb-2">Total Discount: - ₹{{ number_format($order['total_discount'] ?? 0) }}</div>
                <div class="text-xl font-bold mb-2">Total Shipping : + ₹{{ number_format($order['total_shippint'] ?? 0) }}</div>
                <div class="text-xl font-bold mb-2">Tax: - ₹{{ number_format($order['tax'] ?? 0) }}</div>
                <div class="text-xl font-bold">Grand Total: ₹{{ number_format($order['grand_total'] ?? 0) }}</div>
            </div>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">Place Order</button>
    </form>
</div>
@endsection