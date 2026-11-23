@extends('layouts.app')

@section('title', 'Customer Details | POS System')

@section('content')
    <h1>Customer Details</h1>

    <p><strong>Name:</strong> {{ $customer->full_name }}</p>
    <p><strong>Email:</strong> {{ $customer->email }}</p>
    <p><strong>Phone:</strong> {{ $customer->phone }}</p>

    <a class="custom-btn btn-edit" href="{{ route('customers.edit', $customer->id) }}">Edit</a>
    <a class="custom-btn btn-delete" href="{{ route('customers.index') }}">Back</a>
@endsection