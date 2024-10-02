<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .dashboard-container {
            padding: 40px;
        }

        .dashboard-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .dashboard-header {
            margin-bottom: 20px;
            text-align: center;
        }

        .logout-btn {
            margin-top: 20px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container dashboard-container">
        <div class="dashboard-header">
            <h2>Admin Dashboard</h2>
            <p>Welcome, <strong>{{ Auth::guard('admin')->user()->name }}</strong>!</p>
        </div>

        <div class="dashboard-card">
            <h4>Manage Customers</h4>
            <a href="{{ route('admin.customers.index') }}" class="btn btn-primary">View All Customers</a>
        </div>

        <div class="dashboard-card">
            <h4>Manage Suppliers</h4>
            <a href="{{ route('admin.suppliers.index') }}" class="btn btn-primary">View All Suppliers</a>
        </div>

        <div class="dashboard-card">
            <h4>Manage Products</h4>
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">View All Products</a>
        </div>

        <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>
