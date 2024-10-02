<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 40px;
        }

        .dashboard-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .dashboard-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
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
    <div class="container">
        <div class="dashboard-header">
            <h1>Welcome to the Supplier Dashboard</h1>
            <p>Hello, <strong>{{ Auth::guard('supplier')->user()->Sname }}</strong>! You are logged in as a supplier.</p>
        </div>

        <div class="dashboard-card">
            <h4>Manage Your Products</h4>
            <a href="{{ route('supplier.products.index') }}" class="btn btn-primary">View All Products</a>
            <a href="{{ route('supplier.products.create') }}" class="btn btn-success">Add New Product</a>
        </div>

        <form action="{{ route('supplier.logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>
