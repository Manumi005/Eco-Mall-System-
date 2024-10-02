<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Order Details</h1>
        <div class="card">
            <div class="card-body">
                <h5>Order ID: {{ $order->id }}</h5>
                <p><strong>Customer Name:</strong> {{ $order->customer->name }}</p>
                <p><strong>Product:</strong> {{ $order->product->name }}</p>
                <p><strong>Status:</strong> {{ $order->status }}</p>
                <p><strong>Total Amount:</strong> ${{ $order->total }}</p>
                <p><strong>Order Date:</strong> {{ $order->created_at }}</p>
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
            </div>
        </div>
    </div>
</body>
</html>
