@extends('home')

@section('order_content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Order Details</h2>
            <a href="{{ route('orders.index') }}" class="btn btn-primary">Back</a>
        </div>
            
        <div>
            <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
            <p><strong>Product:</strong> {{ $order->product->name }}</p>
            <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
            <p><strong>Total:</strong> ${{ $order->total }}</p>
        </div>
    </div>
@endsection
