<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #0066cc;
        }

        .order-details,
        .order-items {
            margin-top: 20px;
        }

        .order-info {
            margin: 10px 0;
            padding: 10px;
            background-color: #e6f0ff;
            border-radius: 5px;
        }

        .order-info h3 {
            margin-top: 0;
            color: #0066cc;
        }

        .order-info p {
            margin: 5px 0;
            font-size: 1.1em;
        }

        .order-items .item {
            background-color: #e6f0ff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .order-items .item h4 {
            margin-top: 0;
            color: #0066cc;
        }

        .item-detail {
            margin: 5px 0;
            font-size: 1.1em;
        }

        .total-price {
            font-size: 1.2em;
            font-weight: bold;
            color: #0066cc;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9em;
            color: #666;
        }

        .button {
            background-color: #0066cc;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #0057a3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Order Details</h1>

        <!-- Order Details -->
        <div class="order-details">
            @if(count($orderItems) > 0)
            <div class="order-info">
                <h3>Order Information</h3>
                <p><strong>Order ID:</strong> {{ $orderItems[0]->order->id }}</p>
                <p><strong>Address:</strong> {{ $orderItems[0]->order->address }}</p>
                <p><strong>Status:</strong> {{ $orderItems[0]->order->status }}</p>
                <p><strong>Payment Type:</strong> {{ $orderItems[0]->order->payment_type }}</p>
                <p><strong>Total (After Tax):</strong> <span class="total-price">${{ number_format($orderItems[0]->order->total, 2) }}</span></p>
            </div>
            @endif
        </div>

        <!-- Order Items -->
        <div class="order-items">
            <h3>Ordered Products</h3>
            @foreach ($orderItems as $item)
            <div class="item">
                <h4>{{ $item->product->name }}</h4>
                <div class="item-detail"><strong>Quantity:</strong> {{ $item->quantity }}</div>
                <div class="item-detail"><strong>Price (Per Unit):</strong> ${{ number_format($item->price, 2) }}</div>
                <div class="item-detail"><strong>Total Price:</strong> ${{ number_format($item->total_price, 2) }}</div>
            </div>
            @endforeach
        </div>

        <!-- Footer -->
        <div class="footer">
            <a href="{{ url('/home') }}" class="button">Back to Home</a>
        </div>
    </div>
</body>

</html>