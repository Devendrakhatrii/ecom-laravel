<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>Welcome | Laravel App</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Instrument Sans', sans-serif;
            background: linear-gradient(135deg, #e6f0ff, #cce0ff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            color: #333;
        }

        .container {
            background: #ffffff;
            padding: 50px 30px;
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            animation: fadeIn 1s ease;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 10px;
            color: #007bff;
        }

        p {
            font-size: 16px;
            margin-bottom: 30px;
            color: #555;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        a {
            display: inline-block;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 10px;
            background-color: #007bff;
            color: #fff;
            font-weight: 600;
            transition: background-color 0.3s, transform 0.2s;
            min-width: 120px;
        }

        a:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        footer {
            margin-top: 30px;
            font-size: 12px;
            color: #aaa;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to Our Laravel App</h1>
        <p>Your gateway to a smooth and secure experience. Register to get started or login to your account.</p>
        <div class="buttons">
            <a href="/register">Register</a>
            <a href="/login">Login</a>
        </div>
        <footer>&copy; {{ date('Y') }} My Laravel App. All rights reserved.</footer>
    </div>
</body>

</html>