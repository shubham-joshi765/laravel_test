<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('Products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->route('orders.create')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $validatedData = $request->all();

            // Create a new Order instance and store the values
            $order = Product::create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
            ]);

            // Optionally, you can do additional processing or redirect to a specific page
            return redirect()->route('products.index')->with('success', 'Product created successfully!');
        } catch (QueryException  $e) {
            if ($e->errorInfo[1] == 1264) {
                // Out of range error for the 'price' column
                return redirect()->back()->withInput()->withErrors(['total' => 'The price value is out of range. Please reduce the value.']);
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
        $product = Product::where('id',$id)->first();
        return view('Products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::where('id',$id)->first();
        return view('Products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|gt:0',
        ]);
        if ($validator->fails()) {
            return redirect()->route('orders.create')
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $validatedData = $request->all();
            $product->update($validatedData);

            return redirect()->route('products.index')->with('success', 'Product updated successfully!');
        } catch (QueryException  $e) {
            if ($e->errorInfo[1] == 1264) {
                // Out of range error for the 'price' column
                return redirect()->back()->withInput()->withErrors(['total' => 'The price value is out of range. Please reduce the value.']);
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
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
