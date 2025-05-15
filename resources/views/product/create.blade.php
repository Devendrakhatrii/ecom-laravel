
@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 font-sans p-4">
    <h1 class="text-2xl font-bold mb-6">{{$product?"Edit":"Create"}} Product</h1>
    <form action="/products/{{$product?$product->product_id:''}}" method="post" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        @csrf
        @if($product)@method('PUT')@endif


        <label for="name" class="block font-bold mb-1">Product Name:</label>
        <input type="text" id="name" name="name"
            value="{{$product?$product->name:''}}"
            class="w-full mb-4 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500" />
        <x-form-error name='name' />

        <label for="description" class="block font-bold mb-1">Description:</label>
        <textarea id="description" name="description"
            class="w-full mb-4 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500">{{$product?$product->description:''}}</textarea>
        <x-form-error name='description' />

        <label for="price" class="block font-bold mb-1">Price:</label>
        <input type="number" id="price" name="price" step="0.01" min="1" value="{{$product?$product->price:''}}"
            class="w-full mb-4 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500" />
        <x-form-error name='price' />

        <label for="quantity" class="block font-bold mb-1">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="{{$product?$product->quantity:''}}"
            class="w-full mb-4 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500" />
        <x-form-error name='quantity' />

        <label for="type" class="block font-bold mb-1">Type:</label>
        <select id="type" name="type" value="{{$product?$product->type:''}}"
            class="w-full mb-4 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500">
            <option value="physical" {{$product && $product->type=='physical' ?"selected":''}}>Physical</option>
            <option value="digital" {{$product && $product->type=='digital' ? "selected":''}}  >Digital</option>
        </select>
        <x-form-error name='type' />

        <button type="submit"
            class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">
            {{ $product?'Edit':'Add'}}
        </button>
    </form>
</div>
@endsection
