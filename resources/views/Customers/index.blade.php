@extends('home')

@section('customer_content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Customer Listing</h2>
        <a href="{{ route('customers.create') }}" class="btn btn-primary">Create</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $customer)
                <tr>
                    <td>{{ $loop->iteration }}
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary btn-sm mr-2">Edit</a>
                        
                        <!-- Delete Button (with a confirmation dialog) -->
                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm mr-2" onclick="return confirm('Are you sure you want to delete this customer?')">Delete</button>
                        </form>

                        <!-- View Button -->
                        <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-info btn-sm ml-2">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="alert alert-info" colspan="5">No customers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $customers->links() }}
</div>
@endsection