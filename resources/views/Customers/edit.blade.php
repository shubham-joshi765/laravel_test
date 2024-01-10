@extends('home')

@section('customer_content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Edit Customer</h2>
            <a href="{{ route('customers.index') }}" class="btn btn-primary">Back</a>
        </div>
            
        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
