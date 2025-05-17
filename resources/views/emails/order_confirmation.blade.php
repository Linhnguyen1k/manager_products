
<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <div class="container">
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-body">
                <h1 class="card-title h4 mb-4">Thank you for your order!</h1>
                <p class="mb-2">Order ID: {{ $order->id }}</p>
                <p class="mb-2">Product: {{ $order->product->name }}</p>
                <p class="mb-2">Quantity: {{ $order->quantity }}</p>
                <p class="mb-2">Total: ${{ $order->total_price }}</p>
                <p class="mb-2">Status: {{ $order->status }}</p>
            </div>
        </div>
    </div>
</body>
</html>