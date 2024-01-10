@extends('home')

@section('customer_content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Create Customer</h2>
            <a href="{{ route('customers.index') }}" class="btn btn-primary">Back</a>
        </div>
            
        <form action="{{ route('customers.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
