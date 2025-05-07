<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>Home Page</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7fb;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #007bff;
            font-size: 36px;
            margin-bottom: 40px;
        }

        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .product-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }

        .product-card a {
            text-decoration: none;
            color: #007bff;
            font-size: 18px;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .product-card a:hover {
            color: #0056b3;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
        }

        p {
            text-align: center;
            font-size: 18px;
            color: #333;
        }

        .no-products {
            font-size: 20px;
            color: #ff6f61;
            text-align: center;
        }

        .action-links {
            text-align: center;
            margin-top: 40px;
        }

        .action-links a {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 0 10px;
            text-decoration: none;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .action-links a:hover {
            background-color: #0056b3;
        }

        .logout-btn {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            transition: background-color 0.3s ease;
            text-decoration: none;
            margin-top: 20px;
            display: inline-block;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }

        .logout-form {
            text-align: center;
            margin-top: 20px;
        }

        .logout-form button {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-form button:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>

    <h1>Welcome to Our Product Store</h1>

    @if ($products && count($products) > 0)
    <div class="product-list">
        @foreach ($products as $product)
        <div class="product-card">
            <a href="/product/{{ $product['id'] }}">{{ $product['name'] }}</a>
        </div>
        @endforeach
    </div>
    @else
    <p class="no-products">No products available.</p>
    @endif

    <div class="action-links">
        <a href="/products/myProducts">My Products</a>
        <a href="/products/othersProducts">Others' Products</a>
        <a href="/cart">View Cart</a>
        <a href="/order">View Order</a>
    </div>

    <div class="logout-form">
        <form method="post" action="/logout">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

</body>

</html>