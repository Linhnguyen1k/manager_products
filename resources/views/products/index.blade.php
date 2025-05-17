
@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-4">Products</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">
                            Price: 
                            @if ($product->isOnSale())
                                <span class="text-success fw-bold">${{ $product->sale_price }}</span>
                                <del class="text-muted">${{ $product->price }}</del>
                            @else
                                <span class="fw-bold">${{ $product->price }}</span>
                            @endif
                        </p>
                        @if ($product->sale_start && !$product->isOnSale() && now()->lt($product->sale_start))
                            <p class="card-text">Sale starts: {{ $product->sale_start->format('d/m/Y H:i') }}</p>
                        @endif
                        @if ($product->isOnSale() && $product->sale_end)
                            <p class="card-text">
                                Sale ends: <span class="countdown" data-end="{{ $product->sale_end->toIso8601String() }}"></span>
                            </p>
                        @endif
                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="mb-3">
                                <label for="quantity-{{ $product->id }}" class="form-label">Quantity</label>
                                <input type="number" name="quantity" id="quantity-{{ $product->id }}" class="form-control" value="1" min="1">
                            </div>
                            <div class="mb-3">
                                <label for="email-{{ $product->id }}" class="form-label">Email</label>
                                <input type="email" name="customer_email" id="email-{{ $product->id }}" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Buy Now</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script>
        $(document).ready(function() {
            $('.countdown').each(function() {
                var endTime = $(this).data('end');
                $(this).countdown(endTime, function(event) {
                    $(this).text(event.strftime('%D days %H:%M:%S'));
                });
            });
        });
    </script>
@endsection