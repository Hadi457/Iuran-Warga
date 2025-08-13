<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Vertical Navbar')</title>
    <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css')}}">
  <style>
    body {
      display: flex;
      margin: 0;
    }
    .sidebar {
      width: 250px;
      height: 100vh;
      background-color: #386641;
      color: white
    }
    .sidebar .nav-link:hover {
    background-color: #2c4a32;
    color: white;
    }
    .sidebar a {
      color: #FED16A
    }
    .sidebar a:hover {
      background-color: #2c4a32;
    }

    h4, a {
      color: #FED16A;
    }
  </style>
</head>
<body>
  <div class="sidebar d-flex flex-column p-3">
    <h4 class="mb-4">KitaRW03</h4>
    <ul class="nav nav-pills flex-column">
      <li class="nav-item">
        <a href="/dashbord" class="nav-link">Dashboard</a>
      </li>
      <li class="nav-item">
        <a href="/iuran" class="nav-link">Data Iuran</a>
      </li>
      <li class="nav-item">
        <a href="/data-warga" class="nav-link">Data Warga</a>
      </li>
      <li class="nav-item">
        <a href="/tagihan" class="nav-link">Tagihan</a>
      </li>
    </ul>
        <div class="nav-item mt-auto">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger w-100 mt-4">Logout</button>
          </form>
        </div>
  </div>
    <div class="mt-4">
        @yield('content')
    </div>
<script src="{{ asset('assets/bootsrap/css/bootstrap.min.css') }}"></script>
</body>
</html>
