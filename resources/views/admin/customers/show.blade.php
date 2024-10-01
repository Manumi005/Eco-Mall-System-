<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1 class="mb-4">Customer Details</h1>

    <ul class="list-group">
        <li class="list-group-item"><strong>Name:</strong> {{ $customer->name }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $customer->email }}</li>
        <li class="list-group-item"><strong>Phone:</strong> {{ $customer->phone }}</li>
        <li class="list-group-item"><strong>Address:</strong> {{ $customer->address }}</li>
        <li class="list-group-item"><strong>DOB:</strong> {{ $customer->dob }}</li>
    </ul>

    <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary mt-3">Back to Customers</a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
