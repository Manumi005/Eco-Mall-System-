<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Registration</title>
    <style>
        /* Styling for better UX */
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 14px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body> 

        <form action="{{ route('supplier.register.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="Sname">Supplier Name</label>
                <input type="text" name="Sname" id="Sname" value="{{ old('Sname') }}" required>
            </div>

            <div class="form-group">
                <label for="Saddress">Address</label>
                <input type="text" name="Saddress" id="Saddress" value="{{ old('Saddress') }}" required>
            </div>

            <div class="form-group">
                <label for="Sphone">Phone</label>
                <input type="text" name="Sphone" id="Sphone" value="{{ old('Sphone') }}" required>
            </div>

            <div class="form-group">
                <label for="Semail">Email</label>
                <input type="email" name="Semail" id="Semail" value="{{ old('Semail') }}" required>
            </div>

            <div class="form-group">
                <label for="Product">Product</label>
                <input type="text" name="Product" id="Product" value="{{ old('Product') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
