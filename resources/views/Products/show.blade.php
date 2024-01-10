@extends('home')

@section('product_content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>{{ $product->name }}</h2>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
        </div>
            
        <div>
            <p><strong>Name:</strong> {{ $product->name }}</p>
            <p><strong>Description:</strong> {{ $product->description }}</p>
            <p><strong>Price:</strong> ${{ $product->price }}</p>
        </div>
    </div>
@endsection
