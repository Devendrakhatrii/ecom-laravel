<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e6f0ff, #cce0ff);
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        h1 {
            color: #007bff;
            margin-bottom: 20px;
            font-size: 32px;
        }

        .cart-container {
            width: 100%;
            max-width: 700px;
        }

        .cart-item {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            animation: fadeIn 0.5s ease;
        }

        .cart-item a {
            text-decoration: none;
            color: #007bff;
            font-weight: 600;
            font-size: 18px;
        }

        .price-quantity {
            font-size: 16px;
            color: #555;
        }

        form {
            margin-top: 10px;
        }

        input[type="number"] {
            padding: 10px;
            width: 80px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-right: 10px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input[type="number"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
            outline: none;
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

        .show-quantity-btn {
            background-color: #6c757d;
            margin-top: 10px;
        }

        .show-quantity-btn:hover {
            background-color: #5a6268;
        }

        .total-summary {
            margin-top: 30px;
            background: #ffffff;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            text-align: center;
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <h1>Your Shopping Cart</h1>

    <div class="cart-container">

        @foreach($cart_items as $cartItem)
        <div class="cart-item">
            <a href="/product/{{$cartItem->product_id}}">{{$cartItem->product->name}}</a>
            <div class="price-quantity">
                <span>Price: ${{$cartItem->product->price}}</span>
                <span>Quantity: {{$cartItem->quantity}}</span>
                <span>Total: ${{$cartItem['total']}}</span>
            </div>

            <form id="cartForm_{{$cartItem->id}}" action="/cart/update_cart/{{$cartItem->id}}" method="post" style="display: none;">
                @csrf
                @method('PUT')
                <label for="quantity_{{$cartItem->id}}">Quantity:</label>
                <input type="number" name="quantity" id="quantity_{{$cartItem->id}}" value="{{$cartItem->quantity}}" min="1" max="{{ $cartItem->product->stock }}" required>

                <button type="submit">Update Cart</button>
            </form>

            <form action="/cart/delete/{{$cartItem->id}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit">Remove Item</button>
            </form>

            <button class="show-quantity-btn" data-id="{{$cartItem->id}}">Change Quantity</button>
        </div>
        @endforeach

        <div class="total-summary">
            Grand Total: ${{ $total }}
        </div>
    </div>

    <a href="/checkout">Checkout</a>

    <script>
        document.querySelectorAll('.show-quantity-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const form = document.getElementById(`cartForm_${id}`);
                form.style.display = 'block';
                this.style.display = 'none';
            });
        });
    </script>
</body>

</html>