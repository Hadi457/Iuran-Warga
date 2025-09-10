<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'KitaRW03 Dashboard')</title>
  <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css')}}">
  <style>
    :root {
      --primary-color: #386641;
      --accent-color: #FED16A;
      --hover-color: #2c4a32;
      --text-color: #ecf0f1;
      --sidebar-width: 250px;
      --sidebar-width-collapsed: 70px;
      --transition-speed: 0.3s;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      overflow-x: hidden;
      margin: 0;
      padding: 0;
    }
    
    /* Sidebar Styles */
    .sidebar {
      width: var(--sidebar-width);
      min-height: 100vh;
      background-color: var(--primary-color);
      transition: all var(--transition-speed) ease;
      z-index: 1000;
      box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
      padding: 0;
    }
    
    .sidebar.collapsed {
      width: var(--sidebar-width-collapsed);
    }
    
    .sidebar-header {
      padding: 25px 20px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      text-align: center;
    }
    
    .sidebar-header h4 {
      color: var(--accent-color);
      font-weight: 700;
      margin: 0;
      font-size: 1.5rem;
      letter-spacing: 1px;
    }
    
    .nav-container {
      padding: 20px 0;
    }
    
    .sidebar .nav-link {
      color: var(--text-color);
      padding: 15px 25px;
      transition: all 0.2s;
      white-space: nowrap;
      overflow: hidden;
      border-left: 4px solid transparent;
      font-size: 1rem;
      display: flex;
      align-items: center;
    }
    
    .sidebar .nav-link:hover {
      background-color: var(--hover-color);
      color: white;
      border-left: 4px solid var(--accent-color);
    }
    
    .sidebar .nav-link.active {
      background-color: var(--hover-color);
      color: var(--accent-color);
      font-weight: 600;
      border-left: 4px solid var(--accent-color);
    }
    
    .sidebar .nav-link i {
      width: 20px;
      text-align: center;
      margin-right: 15px;
      transition: margin var(--transition-speed) ease;
    }
    
    .sidebar.collapsed .nav-link i {
      margin-right: 0;
    }
    
    .sidebar.collapsed .nav-link span {
      display: none;
    }
    
    .logo-icon {
      font-size: 24px;
      color: var(--accent-color);
      display: none;
    }
    
    .sidebar.collapsed .logo-icon {
      display: block;
    }
    
    .sidebar.collapsed .logo-text {
      display: none;
    }
    
    /* Toggle Button */
    .sidebar-toggle {
      position: fixed;
      bottom: 20px;
      left: 20px;
      z-index: 1001;
      background-color: var(--primary-color);
      color: white;
      border: none;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      transition: all var(--transition-speed) ease;
    }
    
    .sidebar-toggle:hover {
      background-color: var(--hover-color);
    }
    
    /* Content Area */
    .content {
      flex: 1;
      padding: 20px;
      transition: margin-left var(--transition-speed) ease;
      min-height: 100vh;
    }
    
    .content.shifted {
      margin-left: var(--sidebar-width-collapsed);
    }
    
    /* Mobile Responsiveness */
    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        left: -var(--sidebar-width);
      }
      
      .sidebar.mobile-open {
        left: 0;
      }
      
      .content.shifted {
        margin-left: 0;
      }
      
      .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
      }
      
      .overlay.active {
        display: block;
      }
    }
    
    /* Logout Button */
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
    
    /* Dashboard Cards */
    .dashboard-card {
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }
    
    .dashboard-card:hover {
      transform: translateY(-5px);
    }
    
    .card-icon {
      font-size: 2rem;
      margin-bottom: 15px;
    }
    
    /* Boardto-inspired styling */
    .nav-divider {
      height: 1px;
      background: rgba(255, 255, 255, 0.1);
      margin: 10px 0;
    }
    
    .nav-title {
      padding: 15px 25px 5px;
      color: #7f8c8d;
      font-size: 0.8rem;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    
    .sidebar.collapsed .nav-title {
      display: none;
    }
  </style>
</head>
<body>
  <div class="d-flex">
    <!-- Overlay for mobile -->
    <div class="overlay" id="sidebarOverlay"></div>
    
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column" id="sidebar">
      <div class="sidebar-header">
        <h4 class="logo-text">KasWarga</h4>
      </div>
      
      <div class="nav-container flex-grow-1">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a href="/dashbord" class="nav-link">
              <i class="fas fa-tachometer-alt"></i>
              <span>Dashbord</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="/kategori-iuran" class="nav-link">
              <i class="fas fa-list-alt"></i>
              <span>Kategori Iuran</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="/data-warga" class="nav-link">
              <i class="fas fa-users"></i>
              <span>Data Warga</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="/officer" class="nav-link">
              <i class="fas fa-user-tie"></i>
              <span>Petugas</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="/anggota-iuran" class="nav-link">
              <i class="fas fa-id-card"></i>
              <span>Anggota Iuran</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="/payment" class="nav-link">
              <i class="fas fa-credit-card"></i>
              <span>Payment</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="/berita" class="nav-link">
              <i class="fa-solid fa-newspaper"></i>
              <span>Berita</span>
            </a>
          </li>
        </ul>
      </div>
      
      <div class="logout-section">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
          </button>
        </form>
      </div>
    </div>

    <!-- Content -->
    <div class="content" id="mainContent">

      <!-- Sample content for demonstration -->
      <div class="container-fluid">
        @yield('content')
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const sidebar = document.getElementById('sidebar');
      const sidebarToggle = document.getElementById('sidebarToggle');
      const mainContent = document.getElementById('mainContent');
      const overlay = document.getElementById('sidebarOverlay');
      const isMobile = window.matchMedia('(max-width: 768px)').matches;
      
      // Initialize sidebar state
      if (isMobile) {
        sidebar.classList.remove('collapsed');
      }
      
      // Toggle sidebar
      function toggleSidebar() {
        if (isMobile) {
          sidebar.classList.toggle('mobile-open');
          overlay.classList.toggle('active');
        } else {
          sidebar.classList.toggle('collapsed');
          mainContent.classList.toggle('shifted');
        }
      }
      
      // Toggle button click event
      sidebarToggle.addEventListener('click', toggleSidebar);
      
      // Close sidebar when clicking on overlay (mobile)
      overlay.addEventListener('click', function() {
        if (isMobile) {
          sidebar.classList.remove('mobile-open');
          overlay.classList.remove('active');
        }
      });
      
      // Automatically adjust on window resize
      window.addEventListener('resize', function() {
        const nowMobile = window.matchMedia('(max-width: 768px)').matches;
        
        if (isMobile !== nowMobile) {
          // Device type changed (e.g., from desktop to mobile)
          window.location.reload(); // Simplest solution for demo
        }
      });
    });
  </script>
</body>
</html>