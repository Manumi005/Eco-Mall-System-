<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    // Register a new customer
    public function register(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'dob' => 'required|date',
            'password' => 'required|string|min:6|confirmed', // Confirm password field is required
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create a new customer
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'dob' => $request->dob,
            'password' => Hash::make($request->password), // Hash the password before storing
        ]);

        return response()->json(['message' => 'Customer registered successfully'], 201);
    }

    // Handle customer login
    public function login(Request $request)
    {
        // Validate login details
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer || !Hash::check($request->password, $customer->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Generate token for customer
        $token = $customer->createToken('Customer Token')->plainTextToken;

        return response()->json([
            'message' => 'Customer login successful',
            'token' => $token,
        ], 200);
    }

    // Handle customer logout
    public function logout()
    {
        // Revoke the current customer's token
        Auth::user()->tokens()->delete();

        return response()->json(['message' => 'Customer logged out successfully'], 200);
    }

    // List all registered customers (for admin view)
    public function index()
    {
        $customers = Customer::all();
        return view('admin.customers.index', compact('customers'));
    }

    // Show the form for creating a new customer (admin action)
    public function create()
    {
        return view('admin.customers.create');
    }

    // Store a new customer (admin action)
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'dob' => 'required|date',
            'password' => 'required|string|min:6|confirmed', // Confirm password field is required
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new customer
        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'dob' => $request->dob,
            'password' => Hash::make($request->password), // Hash the password before storing
        ]);

        return redirect()->route('admin.customers.index')->with('message', 'Customer added successfully');
    }

    // Show the edit form for a specific customer
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }

    // Update a customer
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,email,' . $customer->id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'dob' => 'required|date',
            // Password is optional; only update if provided
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update the customer
        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'dob' => $request->dob,
            // Hash the password if provided, otherwise keep the current one
            'password' => $request->filled('password') ? Hash::make($request->password) : $customer->password,
        ]);

        return redirect()->route('admin.customers.index')->with('message', 'Customer updated successfully');
    }

    // Delete a customer by ID
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $customer->delete();
        return redirect()->route('admin.customers.index')->with('message', 'Customer deleted successfully');
    }
}
