<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Add Supplier</h1>
        <form action="{{ route('admin.suppliers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="Sname" class="form-label">Supplier Name</label>
                <input type="text" class="form-control" id="Sname" name="Sname" required>
            </div>
            <div class="mb-3">
                <label for="Saddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="Saddress" name="Saddress" required>
            </div>
            <div class="mb-3">
                <label for="Sphone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="Sphone" name="Sphone" required>
            </div>
            <div class="mb-3">
                <label for="Semail" class="form-label">Email</label>
                <input type="email" class="form-control" id="Semail" name="Semail" required>
            </div>
            <div class="mb-3">
                <label for="Product" class="form-label">Product</label>
                <input type="text" class="form-control" id="Product" name="Product" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-success">Add Supplier</button>
        </form>
    </div>
</body>
</html>
