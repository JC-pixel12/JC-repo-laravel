@extends('layouts.app')

@section('title', 'Products | POS System')

@section('content')
    <h1>Products</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif

    <a class="custom-btn btn-view" href="{{ route('products.create') }}">Add Product</a>

    <table cellpadding="10">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('uploads/products/' . $product->image) }}"
                                width="80" height="80"
                                style="object-fit:cover">
                        @else
                            No image
                        @endif
                    </td>

                    <td>{{ $product->name }}</td>
                    <td>₱{{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock_quantity }}</td>

                    <td>
                        <a class="custom-btn btn-view" href="{{ route('products.show', $product->id) }}">View</a>

                        <a class="custom-btn btn-edit" href="{{ route('products.edit', $product->id) }}">Edit</a>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')

                            <button class="custom-btn btn-delete" type="submit" onclick="return confirm('Delete this product?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection