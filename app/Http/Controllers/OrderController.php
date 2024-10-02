<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Display all orders for Admin
    public function index()
    {
        $orders = Order::all(); // Retrieve all orders
        return view('admin.orders.index', compact('orders'));
    }

    // Display a specific order details (Admin/Supplier)
    public function show($id)
    {
        $order = Order::findOrFail($id); // Retrieve a single order by its ID
        return view('orders.show', compact('order'));
    }

    // Update order status (Admin/Supplier)
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status; // Update the status field (e.g., Pending, Shipped, Delivered)
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    // Display orders for the supplier (Supplier-specific)
    public function supplierOrders()
    {
        $orders = auth()->user()->orders; // Assuming suppliers have an 'orders' relationship
        return view('supplier.orders.index', compact('orders'));
    }
}
