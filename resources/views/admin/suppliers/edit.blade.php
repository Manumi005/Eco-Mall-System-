<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Supplier</h1>
        <form action="{{ route('admin.suppliers.update', $supplier->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="Sname" class="form-label">Name</label>
                <input type="text" class="form-control" id="Sname" name="Sname" value="{{ old('Sname', $supplier->Sname) }}" required>
            </div>
            <div class="mb-3">
                <label for="Saddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="Saddress" name="Saddress" value="{{ old('Saddress', $supplier->Saddress) }}" required>
            </div>
            <div class="mb-3">
                <label for="Sphone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="Sphone" name="Sphone" value="{{ old('Sphone', $supplier->Sphone) }}" required>
            </div>
            <div class="mb-3">
                <label for="Semail" class="form-label">Email</label>
                <input type="email" class="form-control" id="Semail" name="Semail" value="{{ old('Semail', $supplier->Semail) }}" required>
            </div>
            <div class="mb-3">
                <label for="Product" class="form-label">Product</label>
                <input type="text" class="form-control" id="Product" name="Product" value="{{ old('Product', $supplier->Product) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Supplier</button>
            <a href="{{ route('admin.suppliers.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
