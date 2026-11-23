@extends('layouts.app')

@section('title', 'Sales History | POS System')

@section('content')
    <h1>Sales History</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif

    <a class="custom-btn btn-view" href="{{ route('sales.create') }}">Record New Sale</a>

    <table cellpadding="10">
        <thead>
            <tr>
                <th>Sale ID</th>
                <th>Product</th>
                <th>Customer</th>
                <th>Staff</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>
            @forelse($sales as $sale)
                <tr>
                    <td>{{ $sale->id }}</td>

                    <td>
                        {{ $sale->product->name ?? 'Deleted Product' }}
                    </td>

                    <td>
                        {{ $sale->customer->full_name ?? 'Walk-in Customer' }}
                    </td>

                    <td>
                        {{ $sale->staff->full_name ?? 'Unknown Staff' }}
                    </td>

                    <td>{{ $sale->quantity }}</td>

                    <td>
                        ₱{{ number_format($sale->total_price, 2) }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($sale->created_at)->format('M d, Y h:i A') }}
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="7">No sales transactions found.</td>
                </tr>

            @endforelse
            
        </tbody>
    </table>
@endsection