@extends('layouts.app')

@section('title', 'Create New Sale | POS System')

@section('content')
    <h1>Record Sale</h1>

    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif

    @if($errors->any())
        <ul style="color:red">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('sales.store') }}" method="POST">
        @csrf

        <label>Product:</label>

        <select name="product_id" required>
            <option value="">Select Product</option>

            @foreach($products as $product)
                <option value="{{ $product->id }}"
                        {{ old('product_id') == $product->id ? 'selected' : '' }}>
                    {{ $product->name }}
                    - ₱{{ number_format($product->price, 2) }}
                    - Stock: {{ $product->stock_quantity }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label>Customer (Optional):</label>

        <select name="customer_id">
            <option value="">Walk-in Customer</option>

            @foreach($customers as $customer)
                <option value="{{ $customer->id }}"
                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                    {{ $customer->full_name }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label>Quantity:</label>

        <input type="number" name="quantity" min="1" value="{{ old('quantity', 1) }}" required>

        <br><br>

        <button class="custom-btn btn-edit" type="submit">Record Sale</button>
    </form>

    <br>

    <a class="custom-btn btn-view" href="{{ route('sales.index') }}">View Sales History</a>
@endsection