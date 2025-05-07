<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>My Products</title>

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
            grid-template-columns: repeat(auto-fit, minmax(250px, max-content));
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
            justify-content: center;
        }

        .product-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 300px;
            text-decoration: none;
            color: inherit;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
        }

        .product-card h2 {
            color: #007bff;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .product-card h2:hover {
            color: #0056b3;
        }

        .product-card .product-info {
            font-size: 16px;
            color: #555;
        }

        .product-card .price {
            font-size: 18px;
            font-weight: bold;
            color: #28a745;
            margin: 15px 0;
        }

        .product-card .stock {
            font-size: 16px;
            color: #888;
        }

        .no-products {
            font-size: 20px;
            color: #ff6f61;
            text-align: center;
        }

        .anchor {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .add-product {
            display: flex;
            width: 10%;
            justify-content: center;
            align-items: center;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            font-size: 18px;
            margin-top: 40px;
            transition: background-color 0.3s ease;
        }

        .add-product:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <h1>My Products</h1>

    @if ($products && count($products) > 0)
    <div class="product-list">
        @foreach ($products as $product)
        <a href="/product/{{ $product['id'] }}" class="product-card">
            <h2>{{ $product['name'] }}</h2>
            <div class="product-info">
                <p class="price">${{ number_format($product['price'], 2) }}</p>
                <p class="stock">Stock: {{ $product['stock'] }}</p>
            </div>
        </a>
        @endforeach
    </div>
    @else
    <p class="no-products">No products available.</p>
    @endif

    <div class="anchor">
        <a href="/product/create" class="add-product">Add Product</a>
    </div>

</body>

</html>