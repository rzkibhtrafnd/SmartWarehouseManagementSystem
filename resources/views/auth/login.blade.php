<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Google Fonts Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('{{ asset('images.png') }}') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            width: 100%;
            max-width: 380px;
        }

        .login-container h2 {
            margin-bottom: 25px;
            color: #333;
            text-align: center;
            font-weight: 600;
            font-size: 28px;
        }

        .login-container .form-group {
            margin-bottom: 20px;
        }

        .login-container input {
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            width: 100%;
        }

        .login-container .form-group input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .login-container button {
            background-color: #007bff;
            border-color: #007bff;
            font-size: 16px;
            padding: 12px;
            width: 100%;
            border-radius: 8px;
            color: white;
            font-weight: 600;
        }

        .login-container button:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .login-container .alert {
            margin-bottom: 20px;
        }

        .login-container img {
            width: 80px;
            height: 80px;
            margin-bottom: 25px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #007bff;
        }

        .input-icon input {
            padding-left: 40px;
        }

        .login-container .form-group input {
            height: 45px;
        }

        .login-container .alert-danger p {
            margin-bottom: 0;
        }

        .text-center {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login Sistem Pergudangan</h2>

        <!-- Display errors if any -->
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Login form -->
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group input-icon">
                <i class="fas fa-user"></i>
                <input type="email" class="form-control" name="email" placeholder="Email" required value="{{ old('email') }}">
            </div>

            <div class="form-group input-icon">
                <i class="fas fa-lock"></i>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
