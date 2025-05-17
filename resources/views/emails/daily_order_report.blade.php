
<!DOCTYPE html>
<html>
<head>
    <title>Daily Order Report</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <div class="container">
        <div class="card mx-auto" style="max-width: 700px;">
            <div class="card-body">
                <h1 class="card-title h4 mb-4">Daily Order Report - {{ now()->toDateString() }}</h1>
                <p class="mb-2">Total Orders: {{ $orders->count() }}</p>
                <p class="mb-4">Total Revenue: ${{ $total }}</p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>${{ $order->total_price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>