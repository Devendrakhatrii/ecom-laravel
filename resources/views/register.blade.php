<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Compact Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center  bg-gray-100 font-sans">
    <form action="/users" method="POST" class="bg-white p-4 rounded-md shadow-md w-full max-w-xs">
        @csrf
        <h1 class="text-center text-base font-semibold text-gray-800 mb-3">Register</h1>

        <x-form-label for="first_name">First Name</x-form-label>
        <x-form-input name='first_name' placeholder='First Name' id="name" :value="old('first_name')"/>
        <x-form-error name='first_name' />


        <x-form-label for="middle_name">Middle Name</x-form-label>
        <x-form-input name='middle_name' placeholder='Middle Name' id="name" :value="old('middle_name')"/>
        <x-form-error name='middle_name' />


        <x-form-label for="last_name">Last Name</x-form-label>
        <x-form-input name='last_name' placeholder='Last Name' id="name" :value="old('last_name')"/>
        <x-form-error name='last_name' />


        <x-form-label for="email">Email</x-form-label>
        <x-form-input name='email' placeholder='Email' id="email" :value="old('email')"/>
        <x-form-error name='email' />

        <x-form-label for="address">Address</x-form-label>
        <x-form-input name='address' placeholder='Address' id="address" :value="old('address')"/>
        <x-form-error name='address' />

        <x-form-label for="password">Password</x-form-label>
        <x-form-input name='password' type='password' placeholder='Password' id="password"/>
        <x-form-error name='password' />


        <x-form-label for="password_confirmation">Confirm Password</x-form-label>
        <x-form-input name='password_confirmation' type='password' placeholder='Confirm Password' id="password"/>
        <x-form-error name='password_confirmation' />

        <x-button type='submit'>Submit</x-button>
    </form>
</body>

</html>