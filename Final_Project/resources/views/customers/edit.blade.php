@extends('layouts.app')

@section('title', 'Edit Customer | POS System')

@section('content')
    <h1>Edit Customer</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('customers.update', $customer->id)}}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Full Name:</label>
            <input type="text" name="full_name" value="{{old('full_name', $customer->full_name)}}" required>
        </div>

        <br>

        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{old('email', $customer->email)}}" required>
        </div>

        <br>

        <div>
            <label>Label:</label>
            <input type="text" name="phone" value="{{old('phone', $customer->phone)}}" required>
        </div>

        <br>

        <button class="custom-btn btn-view" type="submit">Update Customer</button>
        <a class="custom-btn btn-delete" href="{{route('customers.index')}}">Cancel</a>

    </form>
@endsection

