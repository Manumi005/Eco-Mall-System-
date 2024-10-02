<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Admin and Supplier: List all products
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            $products = Product::all(); // Admin can see all products
        } elseif (Auth::guard('supplier')->check()) {
            $supplierId = Auth::guard('supplier')->id();
            $products = Product::where('supplier_id', $supplierId)->get(); // Supplier can see only their products
        } else {
            return redirect()->route('customer.products.index'); // Redirect if customer
        }

        return view('products.index', compact('products'));
    }

    // Supplier: Show form to create a new product
    public function create()
    {
        return view('products.create');
    }

    // Supplier: Store a new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $product = new Product($request->all());
        $product->supplier_id = Auth::guard('supplier')->id(); // Set supplier ID
        $product->save();

        return redirect()->route('supplier.products.index')->with('success', 'Product added successfully.');
    }

    // Supplier: Show form to edit a product
    public function edit(Product $product)
    {
        if ($product->supplier_id !== Auth::guard('supplier')->id()) {
            abort(403); // Unauthorized access
        }

        return view('products.edit', compact('product'));
    }

    // Supplier: Update a product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $product->update($request->all());

        return redirect()->route('supplier.products.index')->with('success', 'Product updated successfully.');
    }

    // Supplier: Delete a product
    public function destroy(Product $product)
    {
        if ($product->supplier_id !== Auth::guard('supplier')->id()) {
            abort(403); // Unauthorized access
        }

        $product->delete();

        return redirect()->route('supplier.products.index')->with('success', 'Product deleted successfully.');
    }
}