<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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

        <label for="image">Image:</label>
        <input type="file" id="image" name="image">

        <button type="submit">Update Product</button>
    </form>

    <a href="{{ route('admin.products.index') }}">Back to Product List</a> <!-- Ensure proper admin prefix for the index route -->
</body>
</html>
