<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border 0.3s;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #66afe9;
            outline: none;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #218838;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }

        a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Edit Product</h1>
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- This is to specify that we are updating the resource -->
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" value="{{ old('price', $product->price) }}" required>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" required>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="{{ old('category', $product->category) }}" required>

        <button type="submit">Update Product</button>
    </form>

    <a href="{{ route('admin.products.index') }}">Back to Product List</a> <!-- Ensure proper admin prefix for the index route -->
</body>
</html>