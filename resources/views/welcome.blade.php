<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('images/eco_mall_1.jpg') no-repeat center center fixed;
            background-size: cover;
            text-align: center;
        }

        .welcome-container {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            display: inline-block;
            text-align: center;
        }

        .logo-container {
            margin: 10px 0;
        }

        .logo-container img {
            width: 300px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        h1, h2 {
            color: #fff;
            margin: 10px 0;
        }

        h2 {
            font-size: 46px;
        }

        .welcome-buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .welcome-buttons a {
            display: inline-block;
            padding: 15px 30px;
            margin: 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s;
            width: 200px;
            text-align: center;
        }

        .welcome-buttons a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h2>Welcome to</h2>
        <div class="logo-container">
            <img src="images/logo.png" alt="Logo">
        </div>
        <div class="welcome-buttons">
            <a href="{{ route('admin.login') }}">Admin Login</a>
            <a href="{{ route('supplier.login') }}">Supplier Login</a>
        </div>
    </div>
</body>
</html>
