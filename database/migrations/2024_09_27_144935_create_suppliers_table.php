<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    // Show the supplier login form
    public function loginForm()
    {
        return view('supplier.login');
    }

    // Handle supplier login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $supplier = Supplier::where('email', $request->email)->first();

        if ($supplier && Hash::check($request->password, $supplier->password)) {
            // Authenticate supplier and redirect to dashboard
            auth()->guard('supplier')->login($supplier);
            return redirect()->route('supplier.dashboard')->with('success', 'Logged in successfully.');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Show the supplier registration form
    public function registerForm()
    {
        return view('supplier.register');
    }

    // Handle supplier registration
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:suppliers',
            'product' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create the supplier
        Supplier::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'product' => $request->product,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('supplier.login')->with('success', 'Registration successful. Please log in.');
    }

    // Show supplier dashboard
    public function dashboard()
    {
        return view('supplier.dashboard');
    }

    // Display a listing of suppliers
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.suppliers.index', compact('suppliers'));
    }

    // Show the form for creating a new supplier
    public function create()
    {
        return view('admin.suppliers.create');
    }

    // Store a newly created supplier
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:suppliers',
            'product' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create the supplier
        Supplier::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'product' => $request->product,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier created successfully.');
    }

    // Show the form for editing the specified supplier
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.edit', compact('supplier'));
    }

    // Update the specified supplier in storage
    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:suppliers,email,' . $supplier->id,
            'product' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->phone = $request->phone;
        $supplier->email = $request->email;
        $supplier->product = $request->product;

        if ($request->filled('password')) {
            $supplier->password = Hash::make($request->password);
        }

        $supplier->save();

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    // Remove the specified supplier from storage
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier deleted successfully.');
    }

    // Handle supplier logout
    public function logout(Request $request)
    {
        auth()->guard('supplier')->logout();
        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
