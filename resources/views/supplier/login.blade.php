<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('images/wallpaper1.jpg') no-repeat center center fixed;
            background-size: cover;
            text-align: center;
        }

        .login-container {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            display: inline-block;
            text-align: center;
        }

        h2 {
            color: #fff;
            margin: 10px 0;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="email"], input[type="password"] {
            padding: 10px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            width: 200px;
        }

        button {
            padding: 15px 30px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .register-link {
            color: #fff;
            margin-top: 10px;
        }

        a {
            color: #00ffcc;
            text-decoration: none;
            margin-top: 15px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Seller Login</h2>
        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <!-- Add a link to the Supplier Registration Page -->
        <p class="register-link">Don't have an account?</p>
        <a href="{{ route('supplier.register') }}">Register as a Supplier</a>
    </div>
</body>
</html>
