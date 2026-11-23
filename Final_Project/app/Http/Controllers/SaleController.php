<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function create()
    {
        $products = Product::where('stock_quantity', '>', 0)
            ->orderBy('name')
            ->get();

        $customers = Customer::orderBy('full_name')
            ->get();

        return view('sales.create', compact('products', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_id' => 'nullable|exists:customers,id',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::transaction(function () use ($request) {

                $product = Product::where('id', $request->product_id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $quantity = (int) $request->quantity;

                if ($quantity > $product->stock_quantity) {
                    throw new \RuntimeException(
                        'Insufficient stock. Available quantity: '
                        . $product->stock_quantity
                    );
                }

                $totalPrice = $product->price * $quantity;

                $product->decrement('stock_quantity', $quantity);

                Sale::create([
                    'product_id' => $product->id,
                    'customer_id' => $request->customer_id ?: null,
                    'sold_by' => auth()->id(),
                    'quantity' => $quantity,
                    'total_price' => $totalPrice,
                    'created_at' => now(),
                ]);
            });

        } catch (\RuntimeException $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());

        } catch (\Throwable $e) {

            return back()
                ->withInput()
                ->with('error', 'Unable to record sale. Please try again.');
        }

        return redirect()->route('sales.index')
            ->with('success', 'Sale recorded successfully.');
    }

    public function index()
    {
        $sales = Sale::with(['product', 'customer', 'staff'])
            ->orderBy('id', 'desc')
            ->get();

        return view('sales.index', compact('sales'));
    }
}
