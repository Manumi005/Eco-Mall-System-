<?php
namespace App\Http\Controllers;
use App\Models\Supplier;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class SupplierController extends Controller
{
    // Register a new supplier
    public function register(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'Sname' => 'required|string|max:255',
            'Saddress' => 'required|string|max:255',
            'Sphone' => 'required|string|max:15',
            'Semail' => 'required|email|unique:suppliers,Semail',
            'Product' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
        // Return validation errors if any
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Create the new supplier
        $supplier = Supplier::create([
            'Sname' => $request->Sname,
            'Saddress' => $request->Saddress,
            'Sphone' => $request->Sphone,
            'Semail' => $request->Semail,
            'Product' => $request->Product,
            'password' => Hash::make($request->password),
        ]);
        // Log the supplier in after registration
        Auth::guard('supplier')->login($supplier);
        // Redirect to the supplier dashboard
        return redirect()->route('supplier.dashboard')->with('success', 'Supplier registered successfully.');
    }
    // Login for supplier
    public function login(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'Semail' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        // Return validation errors if any
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Attempt to log the supplier in
        if (!Auth::guard('supplier')->attempt(['Semail' => $request->Semail, 'password' => $request->password])) {
            return redirect()->back()->with('error', 'Invalid credentials.');
        }
        // Redirect to the supplier dashboard after login
        return redirect()->route('supplier.dashboard')->with('success', 'Logged in successfully.');
    }
    // Show the list of suppliers
    public function index()
    {
        // Retrieve all suppliers from the database
        $suppliers = Supplier::all();
        // Pass suppliers data to the view
        return view('admin.suppliers.index', compact('suppliers'));
    }
    // Show the form to create a new supplier
    public function create()
    {
        return view('admin.suppliers.create');
    }
    // Store new supplier details
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'Sname' => 'required|string|max:255',
            'Saddress' => 'required|string|max:255',
            'Sphone' => 'required|string|max:15',
            'Semail' => 'required|email|unique:suppliers,Semail',
            'Product' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
        // Return validation errors if any
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Create a new supplier record
        Supplier::create([
            'Sname' => $request->Sname,
            'Saddress' => $request->Saddress,
            'Sphone' => $request->Sphone,
            'Semail' => $request->Semail,
            'Product' => $request->Product,
            'password' => Hash::make($request->password),
        ]);
        // Redirect to the supplier index page
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier created successfully.');
    }
    // Show the form to edit supplier details
    public function edit($id)
    {
        // Find the supplier by ID
        $supplier = Supplier::findOrFail($id);
        // Pass the supplier to the edit view
        return view('admin.suppliers.edit', compact('supplier'));
    }
    // Update supplier details
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'Sname' => 'required|string|max:255',
            'Saddress' => 'required|string|max:255',
            'Sphone' => 'required|string|max:15',
            'Semail' => 'required|email|unique:suppliers,Semail,' . $id,
            'Product' => 'required|string|max:255',
        ]);
        // Return validation errors if any
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Find the supplier and update details
        $supplier = Supplier::findOrFail($id);
        $supplier->update([
            'Sname' => $request->Sname,
            'Saddress' => $request->Saddress,
            'Sphone' => $request->Sphone,
            'Semail' => $request->Semail,
            'Product' => $request->Product,
        ]);
        // Redirect to the supplier index page
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier updated successfully.');
    }
    // Delete a supplier
    public function destroy($id)
    {
        // Find the supplier by ID and delete
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        // Redirect to the supplier index page
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}