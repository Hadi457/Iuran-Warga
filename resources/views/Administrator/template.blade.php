<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pamoyanan</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <link href="https://cdn.datatables.net/v/dt/dt-2.0.2/datatables.min.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/v/dt/dt-2.0.2/datatables.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.0/js/responsive.bootstrap5.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.bootstrap5.css" rel="stylesheet">
  <style>
    :root {
      --primary-color: #386641;
      --accent-color: #FED16A;
      --hover-color: #2c4a32;
      --text-color: #ecf0f1;
    }
    
    .sidebar {
      background-color: var(--primary-color);
    }
    
    .sidebar .nav-link {
      color: var(--text-color);
      border-left: 4px solid transparent;
    }
    
    .sidebar .nav-link:hover {
      background-color: var(--hover-color);
      color: white;
      border-left: 4px solid var(--accent-color);
    }
    
    .sidebar .nav-link.active {
      background-color: var(--hover-color);
      color: var(--accent-color);
      border-left: 4px solid var(--accent-color);
    }
    
    .logout-btn {
      background-color: transparent;
      color: var(--text-color);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .logout-btn:hover {
      background-color: rgba(255, 255, 255, 0.1);
      color: var(--accent-color);
    }
    
    .dashboard-card {
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }
    
    .dashboard-card:hover {
      transform: translateY(-5px);
    }
  </style>
</head>
<body style="font-family: 'Poppins', sans-serif;">
  <div class="container-fluid">
    <div class="row" style="height: 100vh;">
      <!-- Sidebar -->
      <div class="col-md-3 col-lg-2 d-md-block sidebar collapse" id="sidebarMenu">
        <div class="d-flex flex-column h-100">
          <div class="pt-3">
            <div class="sidebar-header text-center mb-3">
              <a class="navbar-brand fw-bold" href="#">
                <img src="{{asset('assets/image/P__3_-removebg-preview.png')}}" alt="Logo" class="img-fluid">
              </a>
            </div>
            
            <ul class="nav flex-column">
              <li class="nav-item">
                <a href="/dashboard" class="nav-link py-3  {{ Request::is('dashboard') ? 'active' : '' }}">
                  <i class="fas fa-tachometer-alt me-2"></i>
                  Dashbord
                </a>
              </li>
              <li class="nav-item">
                <a href="/kategori-iuran" class="nav-link py-3   {{ Request::is('kategori-iuran') ? 'active' : '' }}">
                  <i class="fas fa-list-alt me-2"></i>
                  Kategori Iuran
                </a>
              </li>
              <li class="nav-item">
                <a href="/data-warga" class="nav-link py-3   {{ Request::is('data-warga') ? 'active' : '' }}">
                  <i class="fas fa-users me-2"></i>
                  Data Warga
                </a>
              </li>
              <li class="nav-item">
                <a href="/officer" class="nav-link py-3  {{ Request::is('officer') ? 'active' : '' }}">
                  <i class="fas fa-user-tie me-2"></i>
                  Petugas
                </a>
              </li>
              <li class="nav-item">
                <a href="/anggota-iuran" class="nav-link py-3  {{ Request::is('anggota-iuran') ? 'active' : '' }}">
                  <i class="fas fa-id-card me-2"></i>
                  Anggota Iuran
                </a>
              </li>
              <li class="nav-item">
                <a href="/payment" class="nav-link py-3  {{ Request::is('payment') ? 'active' : '' }}">
                  <i class="fas fa-credit-card me-2"></i>
                  Payment
                </a>
              </li>
              <li class="nav-item">
                <a href="/activity" class="nav-link py-3   {{ Request::is('activity') ? 'active' : '' }}">
                  <i class="fa-solid fa-newspaper me-2"></i>
                  Berita
                </a>
              </li>
            </ul>
          </div>
          
          <!-- Logout Section - Always at the bottom -->
          <div class="mt-auto mb-3 pt-3 border-top">
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="btn logout-btn w-100 py-2">
                <i class="fas fa-sign-out-alt me-2"></i>
                Logout
              </button>
            </form>
          </div>
        </div>
      </div>

      <!-- Main Content -->
      <main class="col-md-9 col-lg-10 ms-sm-auto px-md-4 bg-light">
        @yield('content')
      </main>
    </div>
  </div>
</body>
</html>
    <script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
