<!-- resources/views/supplier/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Dashboard</title>
</head>
<body>
    <h1>Welcome to the Supplier Dashboard</h1>
    <p>Hello, {{ Auth::guard('supplier')->user()->Sname }}! You are logged in as a supplier.</p>
</body>
</html>
