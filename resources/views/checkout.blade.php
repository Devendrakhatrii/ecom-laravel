<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f8ff;
            color: #003366;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 51, 102, 0.2);
        }

        h1,
        h2 {
            color: #004080;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #80bfff;
            border-radius: 5px;
        }

        .cart-item {
            margin-top: 15px;
            padding: 10px;
            background-color: #e6f2ff;
            border-radius: 5px;
            border: 1px solid #cce6ff;
        }

        .summary {
            margin-top: 20px;
            padding: 15px;
            background-color: #e0f0ff;
            border-radius: 5px;
            border: 1px solid #99ccff;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #0059b3;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #0073e6;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0059b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="/order" method="post">
            @csrf

            <label for="address">Address</label>
            <input type="text" name="address" id="address">

            <label for="paymentType">Payment Method</label>
            <select name="payment_type" id="paymentType">
                @foreach($paymentMethods as $type)
                <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                @endforeach
            </select>

            <h2>Cart Items</h2>
            @foreach($cart_items as $cartItem)
            <div class="cart-item">
                <strong>Product:</strong> {{ $cartItem['product']['name'] }}<br>
                <strong>Price:</strong> {{ $cartItem['product']['price'] }}<br>
                <strong>Quantity:</strong> {{ $cartItem['quantity'] }}<br>
                <strong>Type:</strong> {{ $cartItem['product']['types'] }}<br>
                <strong>Total:</strong> {{ $cartItem['total'] }}
            </div>
            @endforeach

            <div class="summary">
                <h2>Order Summary</h2>
                <p><strong>Total Price:</strong> {{ $totalPrice }}</p>
                <p><strong>Tax:</strong> {{ $tax }}</p>
                <p><strong>Grand Total:</strong> {{ $grandTotal }}</p>
            </div>

            <button type="submit">Place Order</button>
        </form>

        <a href="/cart" class="back-link">← Back to Cart</a>
    </div>
</body>

</html>