@extends('home')

@section('order_content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mr-auto">Orders Listing</h2>
            <div class="d-flex">
                <a href="{{ route('orders.create') }}" class="btn btn-primary ml-2">Create</a>
                <a href="{{ route('orders.downloadPDF') }}" class="btn btn-success mr-2 ml-2">Download PDF</a>
            </div>
        </div>
    
        <table class="table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}
                        <td>{{ $order->customer->name }}</td>
                        <td>{{ $order->product->name }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>${{ $order->total }}</td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary btn-sm mr-2">Edit</a>
                            
                            <!-- Delete Button (with a confirmation dialog) -->
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mr-2" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                            </form>
    
                            <!-- View Button -->
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm ml-2">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="alert alert-info" colspan="6">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    
        {{ $orders->links() }}
    </div>
@endsection