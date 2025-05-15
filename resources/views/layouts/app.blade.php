<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow mb-8">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="text-xl font-bold text-gray-800">
                <a href="/">Ecommerce</a>
            </div>
            <div class="flex items-center space-x-4">
                @guest
                    <x-button onclick="window.location.href='/login'">Login</x-button>
                    <x-button onclick="window.location.href='/users/create'">Register</x-button>
                @endguest

                @auth
                    <x-button onclick="window.location.href='/dashboard'">Dashboard</x-button>
                    <x-logout-button/>
                @endauth
            </div>
        </div>
    </nav>
    <main class="container mx-auto px-4">
        @yield('content')
    </main>
</body>
</html>
