<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // Display a listing of the suppliers
    public function index()
    {
        // Fetch all suppliers from the database
        $suppliers = Supplier::all();
        
        // Pass the suppliers to the view
        return view('admin.suppliers.index', compact('suppliers'));
    }

    // Show the form for creating a new supplier
    public function create()
    {
        return view('admin.suppliers.create');
    }

    // Store a newly created supplier in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'Sname' => 'required|string|max:255',
            'Saddress' => 'required|string|max:255',
            'Sphone' => 'required|string|max:15',
            'Semail' => 'required|email|unique:suppliers,Semail',
            'Product' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new supplier in the database
        Supplier::create([
            'Sname' => $request->Sname,
            'Saddress' => $request->Saddress,
            'Sphone' => $request->Sphone,
            'Semail' => $request->Semail,
            'Product' => $request->Product,
            'password' => bcrypt($request->password),
        ]);

        // Redirect to the suppliers list with a success message
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier created successfully.');
    }

    // Show the form for editing the specified supplier
    public function edit($id)
    {
        // Find the supplier by its ID
        $supplier = Supplier::findOrFail($id);

        // Pass the supplier to the edit view
        return view('admin.suppliers.edit', compact('supplier'));
    }

    // Update the specified supplier in the database
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'Sname' => 'required|string|max:255',
            'Saddress' => 'required|string|max:255',
            'Sphone' => 'required|string|max:15',
            'Semail' => 'required|email|unique:suppliers,Semail,'.$id,
            'Product' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Find the supplier by its ID
        $supplier = Supplier::findOrFail($id);

        // Update the supplier's details
        $supplier->update([
            'Sname' => $request->Sname,
            'Saddress' => $request->Saddress,
            'Sphone' => $request->Sphone,
            'Semail' => $request->Semail,
            'Product' => $request->Product,
            'password' => $request->password ? bcrypt($request->password) : $supplier->password,
        ]);

        // Redirect to the suppliers list with a success message
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    // Remove the specified supplier from the database
    public function destroy($id)
    {
        // Find the supplier by its ID and delete it
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        // Redirect to the suppliers list with a success message
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
