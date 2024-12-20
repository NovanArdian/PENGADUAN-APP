<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #96d50c, #a0c51c);
            color: #fff;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-container {
            display: flex;
            background: #ffffff;
            color: #333;
            width: 90%;
            max-width: 1000px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .image-content {
            flex: 1;
            background: url('https://i.pinimg.com/originals/bd/09/7c/bd097c52da9e7a7134d4d4c5a61b0dfb.jpg') no-repeat center center/cover;
        }

        .register-form {
            flex: 1;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        .register-title {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .form-group label {
            font-weight: 500;
        }

        .btn-register {
            background: linear-gradient(135deg, #25981a, #2bca22);
            color: #fff;
            font-weight: bold;
            border: none;
            transition: all 0.3s ease-in-out;
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #274154, #31c651);
            transform: scale(1.05);
        }

        .text-center p {
            margin-top: 1rem;
            font-size: 0.9rem;
        }

        .text-center a {
            color: #4facfe;
            text-decoration: none;
            font-weight: 600;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .register-container {
                flex-direction: column;
                max-width: 90%;
            }

            .image-content {
                height: 200px;
            }
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="image-content"></div>
        <div class="register-form">
            <h2 class="register-title">Create an Account</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>
                    <small class="text-muted">Make sure your password is strong and easy to remember.</small>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-register btn-block">Register</button>
            </form>

            <div class="text-center mt-3">
                <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
            </div>
        </div>
    </div>
</body>

</html>
