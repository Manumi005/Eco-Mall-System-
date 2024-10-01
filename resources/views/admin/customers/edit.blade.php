<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1 class="mb-4">Edit Customer</h1>

    <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $customer->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $customer->email }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" value="{{ $customer->phone }}" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" id="address" value="{{ $customer->address }}" required>
        </div>
        <div class="form-group">
            <label for="dob">DOB</label>
            <input type="date" name="dob" class="form-control" id="dob" value="{{ $customer->dob }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update Customer</button>
    </form>
    <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary mt-3">Back to Customers</a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
