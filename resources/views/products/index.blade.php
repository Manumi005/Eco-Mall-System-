<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td img {
            max-width: 100px;
            max-height: 100px;
        }

        td a {
            padding: 5px 10px;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
        }

        td a:hover {
            background-color: #0056b3;
        }

        button {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #c82333;
        }

        p {
            color: green;
            font-size: 1.1em;
        }

        .add-product {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .add-product:hover {
            background-color: #218838;
        }

        .back-dashboard {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .back-dashboard:hover {
            background-color: #0056b3;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Product List</h1>

      
        <!-- Show 'Add New Product' only if the user is an admin -->
        @if (Auth::guard('admin')->check())
            <a class="add-product" href="{{ route('admin.products.create') }}">Add New Product</a>
        @endif

        <!-- Display success message if product was updated/created successfully -->
        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif

        <!-- Product List Table -->
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Supplier ID</th>
                    <th>Supplier Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Category</th>
                  
                    @if (Auth::guard('supplier')->check() || Auth::guard('admin')->check())
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->supplier_id }}</td> <!-- Display Supplier ID -->
                        <td>{{ $product->supplier->Sname ?? 'N/A' }}</td> <!-- Display Supplier Name, assuming a relationship exists -->

                        <td>Rs.{{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->category }}</td>
                      
                        <!-- Show Edit/Delete actions based on authentication -->
                        @if (Auth::guard('admin')->check())
                            <td>
                                <!-- Admin Edit and Delete -->
                                <a href="{{ route('admin.products.edit', $product->id) }}">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        @elseif (Auth::guard('supplier')->check())
                            <td>
                                <!-- Supplier Edit only -->
                                <a href="{{ route('supplier.products.edit', $product->id) }}">Edit</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>