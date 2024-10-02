<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Registration</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Form Styles */
        form {
            display: flex;
            flex-direction: column;
        }

        /* Label Styling */
        label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        /* Input Field Styling */
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            background-color: #fafafa;
            transition: border-color 0.3s ease;
        }

        /* Input Focus Styles */
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
            background-color: #f0f8ff;
        }

        /* Button Styling */
        button[type="submit"] {
            padding: 12px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Error Message Styling */
        .error {
            color: red;
            margin-bottom: 15px;
        }

        /* Media Query for Mobile Devices */
        @media (max-width: 500px) {
            .container {
                margin: 20px;
                padding: 20px;
            }

            button[type="submit"] {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Supplier Registration</h2>
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
