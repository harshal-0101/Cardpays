<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4; 
            /* display: flex;
            justify-content: center;
            align-items: center; */
            height: 100vh; 
            margin: 10 auto;
        }

        .login-container {
            margin: 10px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 24px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .login-button {
            width: 100%;
            padding: 10px;
            background-color: #007bff; 
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

@extends('layout.app')

@section('title', 'Home Page')

@section('content')

    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="POST" action="{{ route('loginU') }}"> 
             @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                @error('email')
                  <div style="color: red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                 <div style="color: red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="tole">
                    <option value="Admin">Admin</option>
                    <option value="Telecaller">Telecaller</option>
                    <option value="Manager">Manager</option>
                    <option value="Accountant">Accountant</option>
                </select>
            </div>

            <button type="submit" class="login-button">Log In</button>

        </form>
    </div>
@endsection
</body>
</html>
