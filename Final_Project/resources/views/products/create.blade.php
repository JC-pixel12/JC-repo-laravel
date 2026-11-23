@extends('layouts.app')

@section('title', 'Create Product | POS System')

@section('content')
    <h1>Add Product</h1>

    @if($errors->any())
        <ul style="color:red">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Product Name:</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
        <br><br>

        <label>Price:</label>
        <input type="number" name="price" step="0.01"
            min="0.01" value="{{ old('price') }}" required>
        <br><br>

        <label>Stock Quantity:</label>
        <input type="number" name="stock_quantity"
            min="0" value="{{ old('stock_quantity', 0) }}" required>
        <br><br>

        <label>Product Image:</label>
        <input type="file" name="image" accept="image/png,image/jpeg">
        <br><br>

        <button class="custom-btn btn-view" type="submit">Save Product</button>
    </form>

    <br>
    
    <a class="custom-btn btn-delete" href="{{ route('products.index') }}">Back</a>    
@endsection