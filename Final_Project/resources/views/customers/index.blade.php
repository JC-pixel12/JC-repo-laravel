@extends('layouts.app')

@section('title', 'Customer Accounts | POS System')

@section('content')
    <h1>Customer Accounts</h1>
    
    @if (session('success'))
        <p style="color: green;">
            {{session('success')}}
        </p>
    @endif

    <a class="custom-btn btn-view" href="{{route('customers.create')}}">+ Add New Customer</a>

    <p>List of registered customers in the POS system.</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->full_name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    
                    <td>
                        <a class="custom-btn btn-view" href="{{ route('customers.show', $customer->id) }}">View</a>
                        <a class="custom-btn btn-edit" href="{{route('customers.edit', $customer->id)}}">Edit</a>

                        <form action="{{ route('customers.destroy', $customer->id) }}"
                            method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')

                            <button class="custom-btn btn-delete" type="submit"
                                    onclick="return confirm('Delete customer?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            
            @empty
                <tr>
                    <td colspan="5">No Customers found.</td>
                </tr>    
                
            @endforelse
        </tbody>
    </table>
@endsection