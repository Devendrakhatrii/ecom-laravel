@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-lg shadow p-8 mt-10">
    <h1 class="text-2xl font-bold mb-6 text-center">User Profile</h1>
    <div class="mb-4">
        <span class="text-gray-700 font-semibold">Full Name:</span>
        <span class="text-gray-900">
            {{ $data['first_name'] }}
            @if(!empty($data['middle_name']))
                {{ $data['middle_name'] }}
            @endif
            {{ $data['last_name'] }}
        </span>
    </div>
    <div class="mb-4">
        <span class="text-gray-700 font-semibold">Email:</span>
        <span class="text-gray-900">{{ $data['email'] }}</span>
    </div>
    <div class="mb-4">
        <span class="text-gray-700 font-semibold">Address:</span>
        <span class="text-gray-900">{{ $data['address'] }}</span>
    </div>
    <div class="mb-4">
        <span class="text-gray-700 font-semibold">Member Since:</span>
        <span class="text-gray-900">{{ \Carbon\Carbon::parse($data['created_at'])->format('F d, Y') }}</span>
    </div>
    <div>
        <span class="text-gray-700 font-semibold">Last Updated:</span>
        <span class="text-gray-900">{{ \Carbon\Carbon::parse($data['updated_at'])->format('F d, Y') }}</span>
    </div>
</div>
@endsection