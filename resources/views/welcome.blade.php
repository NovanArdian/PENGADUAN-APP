<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <title>Pengaduan Masyarakat</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
        }

        .hero {
            display: flex;
            align-items: center;
            background: linear-gradient(to right, #f57c00 50%, rgba(255, 255, 255, 0.9) 50%);
            height: 100vh;
            overflow: hidden;
            position: relative;
            color: #ffffff;
        }

        .hero::after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 50%;
            background: url('https://images.pexels.com/photos/3441728/pexels-photo-3441728.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500') center/cover no-repeat;
            opacity: 0.3;
            z-index: 1;
        }

        .content {
            max-width: 600px;
            margin-left: 5%;
            text-align: left;
            z-index: 2;
        }

        .title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .description {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            color: #ffffff;
        }

        .auth-buttons .button {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #00695c;
            color: #ffffff;
            font-size: 1rem;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .auth-buttons .button:hover {
            background-color: #004d40;
        }

        @media (max-width: 768px) {
            .hero {
                flex-direction: column;
                text-align: center;
            }

            .content {
                margin: 0 auto;
            }

            .hero::after {
                left: 0;
                top: 50%;
                height: 50%;
            }
        }
    </style>
</head>
<body>
    <div class="hero">
        <div class="content">
            <h1 class="title">Pengaduan</h1>
            <h2 class="subtitle">Pengaduan Masyarakat</h2>
            <p class="description">Sampaikan laporan Anda langsung kepada instansi pemerintah berwenang dengan mudah dan cepat.</p>
            <div class="auth-buttons">
                <a href="{{ route('login') }}" class="button">Bergabung!</a>
            </div>
        </div>
    </div>
</body>
</html>
