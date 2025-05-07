<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>{{ $product->name }}</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7fb;
            margin: 0;
            padding: 20px;
        }

        .product-container {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007bff;
            font-size: 28px;
            margin-bottom: 15px;
            text-align: center;
        }

        ul {
            list-style: none;
            padding: 0;
            margin-bottom: 20px;
        }

        li {
            font-size: 18px;
            color: #333;
            margin: 8px 0;
        }

        .product-info {
            margin-bottom: 20px;
        }

        .product-info ul {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .buttons-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        #showQuantityBtn {
            background-color: #6c757d;
        }

        #showQuantityBtn:hover {
            background-color: #5a6268;
        }

        .quantity-form {
            display: none;
            margin-top: 10px;
        }

        .quantity-form input {
            padding: 10px;
            width: 80px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-right: 10px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .quantity-form input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        .buttons-container form {
            margin: 0;
        }
    </style>
</head>

<body>

    <div class="product-container">
        <h1>{{ $product->name }}</h1>

        <div class="product-info">
            <ul>
                <li><strong>Stock:</strong> {{ $product->stock }}</li>
                <li><strong>Price:</strong> ${{ $product->price }}</li>
                <li><strong>Type:</strong> {{ $product->types }}</li>
            </ul>
        </div>

        @if($isMyProduct)
        <div class="buttons-container">
            <a href="/product/{{ $product->id }}/edit">
                <button>Edit</button>
            </a>

            <form method="post" action="/product/{{ $product->id }}/delete">
                @csrf
                @method("DELETE")
                <button type="submit">Delete</button>
            </form>
        </div>
        @elseif(!$isMyProduct)
        <div class="buttons-container">
            <form id="cartForm" method="POST" action="/cart/add_cart" class="quantity-form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" required>

                <button type="submit">Add to Cart</button>
            </form>

            <button id="showQuantityBtn">Add to Cart</button>
        </div>
        @endif
    </div>

    <script>
        const showQuantityBtn = document.getElementById('showQuantityBtn');
        const cartForm = document.getElementById('cartForm');

        showQuantityBtn.addEventListener('click', function() {
            cartForm.style.display = 'block';
            showQuantityBtn.style.display = 'none';
        });
    </script>

</body>

</html>