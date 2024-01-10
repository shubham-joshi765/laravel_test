@extends('home')

@section('product_content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Products Listing</h2>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Create</a>
        </div>
    
        <table class="table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm mr-2">Edit</a>
                            
                            <!-- Delete Button (with a confirmation dialog) -->
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mr-2" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                            </form>

                            <!-- View Button -->
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm ml-2">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="alert alert-info" colspan="5">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    
        {{ $products->links() }}
    </div>
@endsection