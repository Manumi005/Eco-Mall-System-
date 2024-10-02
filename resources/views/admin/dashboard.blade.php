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

        .dashboard-header {
            margin-bottom: 40px;
            text-align: center;
        }

        .dashboard-header h2 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .dashboard-header p {
            font-size: 1.2rem;
            color: #555;
        }

        .dashboard-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.2s;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .dashboard-card h4 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .dashboard-card a {
            width: 100%;
            text-align: center;
            padding: 10px;
            font-size: 1.1rem;
        }

        .logout-btn {
            margin-top: 20px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 1rem;
            width: auto;
            display: block;
            margin: 0 auto;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }

        @media (min-width: 768px) {
            .dashboard-card {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 20px 30px;
            }

            .dashboard-card a {
                flex-grow: 1;
                margin-left: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container dashboard-container">
        <div class="dashboard-header">
            <h2>Admin Dashboard</h2>
            <p>Welcome, <strong>{{ Auth::guard('admin')->user()->name }}</strong>!</p>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="dashboard-card text-center">
                    <h4>Manage Customers</h4>
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-primary">View All Customers</a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="dashboard-card text-center">
                    <h4>Manage Suppliers</h4>
                    <a href="{{ route('admin.suppliers.index') }}" class="btn btn-primary">View All Suppliers</a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="dashboard-card text-center">
                    <h4>Manage Products</h4>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-primary">View All Products</a>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4">
                <div class="dashboard-card text-center">
                    <h4>Manage Orders</h4>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">View All Orders</a>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.logout') }}" method="POST" style="margin-top: 30px;">
            @csrf
            <button type="submit" class="btn logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>
