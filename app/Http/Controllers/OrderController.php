<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::paginate(10);
        return view('Orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();

        return view('Orders.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->route('orders.create')
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $validatedData = $request->all();
            $product = Product::findOrFail($validatedData['product_id']);
            $total = $product->price * $validatedData['quantity'];

            Order::create([
                'customer_id' => $validatedData['customer_id'],
                'product_id' => $validatedData['product_id'],
                'quantity' => $validatedData['quantity'],
                'total' => $total,
            ]);

            return redirect()->route('orders.index')->with('success', 'Order created successfully!');
        } catch (QueryException  $e) {
            if ($e->errorInfo[1] == 1264) {
                // Out of range error for the 'total' column
                return redirect()->back()->withInput()->withErrors(['total' => 'The total value is out of range. Please reduce the quantity.']);
            }

            // Handle other database-related errors if needed
            return redirect()->back()->withInput()->withErrors(['database' => 'Database error.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        $customers = Customer::all();
        $products = Product::all();

        return view('orders.edit', compact('order', 'customers', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        if ($validator->fails()) {
            return redirect()->route('orders.create')
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $validatedData = $request->all();
            $order = Order::findOrFail($id);
            $product = Product::findOrFail($validatedData['product_id']);
            $total = $product->price * $validatedData['quantity'];

            $order->update([
                'customer_id' => $validatedData['customer_id'],
                'product_id' => $validatedData['product_id'],
                'quantity' => $validatedData['quantity'],
                'total' => $total,
            ]);

            return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
        } catch (QueryException  $e) {
            if ($e->errorInfo[1] == 1264) {
                // Out of range error for the 'total' column
                return redirect()->back()->withInput()->withErrors(['total' => 'The total value is out of range. Please reduce the quantity.']);
            }

            // Handle other database-related errors if needed
            return redirect()->back()->withInput()->withErrors(['database' => 'Database error.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
    }

    public function downloadPDF()
    {
        $orders = Order::all();
        $pdf = PDF::loadView('orders.pdf', compact('orders'));

        // Download the PDF with a specific filename
        return $pdf->download('orders.pdf');
    }
}
