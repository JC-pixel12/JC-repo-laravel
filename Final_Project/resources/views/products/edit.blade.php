@extends('layouts.app')

@section('title', 'Edit Product | POS System')

@section('content')
    <h1>Edit Product</h1>

    @if($errors->any())
        <ul style="color:red">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Product Name:</label>
        <input type="text" name="name"
            value="{{ old('name', $product->name) }}" required>
        <br><br>

        <label>Price:</label>
        <input type="number" name="price" step="0.01" min="0.01"
            value="{{ old('price', $product->price) }}" required>
        <br><br>

        <label>Stock Quantity:</label>
        <input type="number" name="stock_quantity" min="0"
            value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
        <br><br>

        @if($product->image)
            <p>Current image:</p>
            <img src="{{ asset('uploads/products/' . $product->image) }}"
                width="100" height="100" style="object-fit:cover">
        @endif

        <br><br>

        <label>New Image:</label>
        <input type="file" name="image" accept="image/png,image/jpeg">
        <br><br>

        <button class="custom-btn btn-view" type="submit">Update Product</button>
    </form>

    <br>

    <a class="custom-btn btn-delete" href="{{ route('products.index') }}">Cancel</a>
@endsection