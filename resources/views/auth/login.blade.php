<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #ff5f6d, #ffc371);
            color: #fff;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            display: flex;
            background: #ffffff;
            color: #333;
            width: 90%;
            max-width: 1000px;
            border-radius: 15px;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .login-form {
            flex: 1;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-group label {
            font-weight: 600;
        }

        .btn-login {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            color: #fff;
            font-weight: bold;
            border: none;
            transition: all 0.3s ease-in-out;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #ff6b6b, #ff4e50);
            transform: scale(1.05);
        }

        .text-center p {
            margin-top: 1rem;
            font-size: 0.9rem;
        }

        .text-center a {
            color: #ff416c;
            text-decoration: none;
            font-weight: 600;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        .login-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('https://assets.promediateknologi.id/crop/0x0:0x0/750x500/webp/photo/2022/01/19/1668864532.jpg') no-repeat center center;
            background-size: cover;
            color: white;
        }

        .password-toggle {
            position: relative;
        }

        .password-toggle .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 90%;
            }

            .login-content {
                padding: 1.5rem;
            }

            .login-form {
                padding: 1.5rem;
            }

            .login-content {
                height: 300px;
                background-size: cover;
            }

            .login-content h1 {
                font-size: 1.8rem;
            }

            .login-content p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-form">
            <h2 class="login-title">Login</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-toggle">
                        <input type="password" name="password" id="password" class="form-control" required>
                        <span class="toggle-password" onclick="showPassword()" id="toggleIcon">
                            <i class="bi bi-eye-slash"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-login btn-block">Login</button>

                <div class="text-center mt-3">
                    <p>Belum punya akun? <a href="{{ route('register') }}">Buat Akun</a></p>
                </div>
            </form>
        </div>
        <div class="login-content">
            <!-- Image already applied as background -->
        </div>
    </div>

    <script>
        function showPassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon').querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'bi bi-eye';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'bi bi-eye-slash';
            }
        }
    </script>
</body>

</html>
