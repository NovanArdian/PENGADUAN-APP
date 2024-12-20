<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
        
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f6f2;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background: linear-gradient(135deg, #e63946, #f77f00);
            box-shadow: 4px 0 12px rgba(0, 0, 0, 0.1);
            color: white;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .sidebar .brand {
            font-weight: 700;
            font-size: 1.8rem;
            letter-spacing: 0.5px;
            margin-bottom: 2rem;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .sidebar .brand img {
            width: 40px;
            height: 40px;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.8rem 1.5rem;
            transition: all 0.3s ease;
            border-radius: 8px;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link i {
            margin-right: 0.7rem;
        }

        .sidebar .nav-link:hover {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .main-content {
            margin-left: 250px;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .user-info {
            margin-top: auto;
            text-align: center;
        }

        .user-info span {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .user-info a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
                padding: 1.5rem;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3b/Logo_of_the_Ministry_of_Villages%2C_Disadvantage_Region_Developments%2C_and_Transmigrations_of_the_Republic_of_Indonesia.svg/2048px-Logo_of_the_Ministry_of_Villages%2C_Disadvantage_Region_Developments%2C_and_Transmigrations_of_the_Republic_of_Indonesia.svg.png" alt="Logo">
            Pengaduan
        </div>
        <nav class="nav flex-column">
            @if(Auth::user()->role === 'GUEST')
                <!-- Tautan untuk GUEST -->
                <a class="nav-link {{ Route::is('report.data-report') ? 'active' : '' }}" href="{{ route('report.data-report') }}">
                    <i class="fa-solid fa-newspaper"></i> Article
                </a>
                <a class="nav-link {{ Route::is('report.myReports') ? 'active' : '' }}" href="{{ route('report.myReports') }}">
                    <i class="fa-solid fa-user"></i> Me
                </a>
            @elseif(Auth::user()->role === 'STAFF')
                <!-- Tautan untuk STAFF -->
                <a class="nav-link {{ Route::is('responses.index') ? 'active' : '' }}" href="{{ route('responses.index') }}">
                    <i class="fa-solid fa-message"></i> Data-Report
                </a>
            @elseif(Auth::user()->role === 'HEAD_STAFF')
                <!-- Tautan untuk HEADSTAFF -->
                <a class="nav-link {{ Route::is('staff.index') ? 'active' : '' }}" href="{{ route('staff.index') }}">
                    <i class="fa-solid fa-users"></i> Staff
                </a>
                <a class="nav-link {{ Route::is('staff.chart') ? 'active' : '' }}" href="{{ route('staff.chart') }}">
                    <i class="fa-solid fa-users"></i> Chart
                </a>
            @endif
        </nav>
        <div class="user-info">
            <span>
                <i class="fa-solid fa-circle-user me-1"></i> {{ Auth::user()->email }}
            </span>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2>@yield('title')</h2>
        <div>
            @yield('content')
        </div>
    </div>

    @stack('script')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQ+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
