<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Customer;
use App\Http\Controllers\CustomerController;  
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Handle the admin login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Validate login request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to log in the admin using provided credentials
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully.');
        }

        // If login fails, return back with error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Handle the admin registration request.
     */
    public function register(Request $request)
    {
        // Prevent admin registration if one already exists
        if (Admin::exists()) {
            return redirect()->route('admin.login')->withErrors([
                'email' => 'Admin registration is not allowed. An admin already exists.',
            ]);
        }

        // Validate registration request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new admin user
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect to admin login page after successful registration
        return redirect()->route('admin.login')->with('success', 'Admin registered successfully.');
    }

    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        // Fetch all customers for dashboard view
        $customers = Customer::all(); // Ensure to import the Customer model at the top

        return view('admin.dashboard', compact('customers'));
    }

    /**
     * Handle admin logout.
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout(); // Log out the admin
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the session token to prevent CSRF

        return redirect()->route('admin.login')->with('success', 'Logged out successfully.'); // Redirect to the admin login page
    }
}
