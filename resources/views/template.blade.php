<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Iuran Warga')</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{asset('fontawesome/css/all.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css')}}">

    <style>
        .logout-section {
        margin-top: auto;
        padding: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .logout-btn {
        background-color: transparent;
        color: var(--text-color);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 5px;
        padding: 12px;
        width: 100%;
        text-align: center;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        }
        
        .logout-btn:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: var(--accent-color);
        }
    </style>
</head>
<body class="bg-light min-vh-100 d-flex flex-column">
    <nav class="navbar navbar-expand-lg p-3" style="background-color: #386641;">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" style="color: #FED16A;" href="#">KitaRW03</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/tata">Tata Tertib</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/contact">Contact</a>
                </li>
                <li class="ms-2 nav-item dropdown">
                    <button class="btn dropdown-toggle" style="background-color: #FED16A;" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li class="nav-item">
                            <span class="nav-link">Hi, {{ Auth::user()->name }}</span>
                        </li>
                        <li><h4 class="dropdown-header">Menu</h4></li>
                        <li><a class="dropdown-item" href="/profil">Profil</a></li>
                        <li><a class="dropdown-item" href="#">Tagihan</a></li>
                        <hr>
                        <li>
                            @auth
                                <div class="logout-section">
                                    <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="logout-btn">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>Logout</span>
                                    </button>
                                    </form>
                                </div>
                            @endauth
                        </li>
                    </ul>
                </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <footer class="mt-5 d-flex justify-content-center align-items-center p-3" style="color: #FED16A; background-color: #386641;">
        <p>&copy; {{ date('Y') }} KitaRW03. All rights reserved.</p>
    </footer>
</body>
</html>
