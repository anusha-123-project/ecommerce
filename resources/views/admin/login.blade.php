<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #007bff, #6c63ff);
            margin: 0;
        }

        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 1.5rem;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .login-container button {
            background: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .login-container button:hover {
            background: #0056b3;
        }

        /* Custom style to make the close button visible */
        .btn-close {
            filter: invert(1);
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <input type="text" name="username" placeholder="Username" value="{{ old('username') }}">
            @error('username')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <input type="password" name="password" placeholder="Password">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <button type="submit">Login</button>
        </form>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
