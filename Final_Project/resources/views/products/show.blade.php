@extends('layouts.app')

@section('title', 'Show Product | POS System')

@section('content')
    <h1>Product Details</h1>

    @if($product->image)
        <img src="{{ asset('uploads/products/' . $product->image) }}"
            width="200" height="200" style="object-fit:cover">
    @endif

    <p><strong>Name:</strong> {{ $product->name }}</p>
    <p><strong>Price:</strong> ₱{{ number_format($product->price, 2) }}</p>
    <p><strong>Stock:</strong> {{ $product->stock_quantity }}</p>

    <a class="custom-btn btn-edit" href="{{ route('products.edit', $product->id) }}">Edit</a>
    <a class="custom-btn btn-delete" href="{{ route('products.index') }}">Back</a>   
@endsection