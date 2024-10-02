<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order; // Import the Order model
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Display a listing of the customers
    public function index()
    {
        // Fetch all customers from the database
        $customers = Customer::all();

        // Pass the customers to the view
        return view('admin.customers.index', compact('customers'));
    }

    // Show the form for creating a new customer
    public function create()
    {
        return view('admin.customers.create');
    }

    // Store a newly created customer in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'dob' => 'required|date',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new customer in the database
        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'dob' => $request->dob,
            'password' => bcrypt($request->password), // Hash the password
        ]);

        // Redirect to the customers list with a success message
        return redirect()->route('admin.customers.index')->with('success', 'Customer created successfully.');
    }

    // Show the form for editing the specified customer
    public function edit($id)
    {
        // Find the customer by its ID
        $customer = Customer::findOrFail($id);

        // Pass the customer to the edit view
        return view('admin.customers.edit', compact('customer'));
    }

    // Update the specified customer in the database
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $id, // Ignore current customer's email
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'dob' => 'required|date',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Find the customer by its ID
        $customer = Customer::findOrFail($id);

        // Update the customer's details
        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'dob' => $request->dob,
            'password' => $request->password ? bcrypt($request->password) : $customer->password, // Hash new password if provided
        ]);

        // Redirect to the customers list with a success message
        return redirect()->route('admin.customers.index')->with('success', 'Customer updated successfully.');
    }

    // Remove the specified customer from the database
    public function destroy($id)
    {
        // Find the customer by its ID and delete it
        $customer = Customer::findOrFail($id);
        $customer->delete();

        // Redirect to the customers list with a success message
        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully.');
    }

    // Display orders for a specific customer
    public function showOrders($id)
    {
        // Find the customer by its ID
        $customer = Customer::findOrFail($id);

        // Fetch the orders for the specified customer
        $orders = $customer->orders; // Assuming you have a relationship defined in the Customer model

        // Pass the orders to the view
        return view('admin.customers.orders.index', compact('customer', 'orders'));
    }

    // Show the form for creating a new order for the specified customer
    public function createOrder($id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customers.orders.create', compact('customer'));
    }

    // Store a newly created order in the database
    public function storeOrder(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'product_id' => 'required|exists:products,id', // Assuming you have a Product model
            'quantity' => 'required|integer|min:1',
            // Add more fields as necessary
        ]);

        // Find the customer by its ID
        $customer = Customer::findOrFail($id);

        // Create a new order for the customer
        $order = new Order([
            'customer_id' => $customer->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            // Add more fields as necessary
        ]);

        // Save the order
        $order->save();

        // Redirect to the customer's orders list with a success message
        return redirect()->route('admin.customers.orders.index', $customer->id)->with('success', 'Order created successfully.');
    }
}
