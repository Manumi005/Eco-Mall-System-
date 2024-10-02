<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <h1>Add New Product</h1>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>
        
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required>
        
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" required>
        
        <label for="image">Image:</label>
        <input type="file" id="image" name="image">
        
        <button type="submit">Add Product</button>
    </form>
    <a href="{{ route('admin.products.index') }}">Back to Product List</a>
</body>
</html>
