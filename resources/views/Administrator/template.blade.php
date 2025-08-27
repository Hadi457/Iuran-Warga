<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Vertical Navbar')</title>
  <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css')}}">

  <style>
    .sidebar {
      width: 250px;
      min-height: 100vh;
      background-color: #386641;
    }
    .sidebar .nav-link {
      color: #FED16A;
    }
    .sidebar .nav-link:hover {
      background-color: #2c4a32;
      color: white;
    }
    h4 {
      color: #FED16A;
    }
  </style>
</head>
<body>
  <div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3">
      <h4 class="mb-4">KitaRW03</h4>
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a href="/dashbord" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="/kategori-iuran" class="nav-link">Kategori Iuran</a>
        </li>
        <li class="nav-item">
          <a href="/data-warga" class="nav-link">Data Warga</a>
        </li>
        <li class="nav-item">
          <a href="/officer" class="nav-link">Officer</a>
        </li>
        <li class="nav-item">
          <a href="/anggota-iuran" class="nav-link">Anggota Iuran</a>
        </li>
        <li class="nav-item">
          <a href="/payment" class="nav-link">Payment</a>
        </li>
      </ul>
      <div class="mt-auto">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-danger w-100 mt-4">Logout</button>
        </form>
      </div>
    </div>

    <!-- Content -->
    <div class="content flex-grow-1 p-4">
      @yield('content')
    </div>
  </div>
</body>
</html>
