<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Compact Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center  bg-gray-100 font-sans">
    <form action="/login" method="POST" class="bg-white p-4 rounded-md shadow-md w-full max-w-xs">
        @csrf
        <h1 class="text-center text-base font-semibold text-gray-800 mb-3">Login</h1>


        <x-form-label for="email">Email</x-form-label>
        <x-form-input name='email' placeholder='Email' id="email" :value="old('email')"/>
        <x-form-error name='email' />

        <x-form-label for="password">Password</x-form-label>
        <x-form-input name='password' type='password' placeholder='Password' id="password"/>
        <x-form-error name='password' />


       <h1>Don't have an acount? <a href="/users/create" class="underline">register</a></h1>

        <x-button type='submit'>Submit</x-button>
    </form>
</body>

</html>