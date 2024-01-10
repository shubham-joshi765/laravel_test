@extends('home')

@section('customer_content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>{{ $customer->name }}</h2>
            <a href="{{ route('customers.index') }}" class="btn btn-primary">Back</a>
        </div>
            
        <div>
            <p><strong>Name:</strong> {{ $customer->name }}</p>
            <p><strong>Email:</strong> {{ $customer->email }}</p>
        </div>
    </div>
@endsection
