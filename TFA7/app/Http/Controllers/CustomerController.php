<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id','asc')->get();

        return view('customers', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' =>  'required|string|max:100',
            'email'     =>  'required|email|max:100',
            'phone'     =>  'nullable|string|max:20'
        ]);

        $validated['created_at'] = Carbon::now();

        Customer::create($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer added successfully!');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        return view('customers.edit', compact('customer'));
    }


    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $validated = $request->validate([
            'full_name' =>  'required|string|max:100',
            'email'     =>  'required|email|max:100',
            'phone'     =>  'nullable|string|max:20'
        ]);

        $customer->update($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer updated successfully!');
    }
}
