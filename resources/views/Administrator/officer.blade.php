@extends('Administrator.template')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Warga - KasWarga</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    :root {
    --primary-color: #386641;
    --accent-color: #FED16A;
    --hover-color: #2c4a32;
    --text-color: #ecf0f1;
    }
    
    body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8f9fa;
    color: var(--text-color);
    }
    
    .page-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--hover-color) 100%);
    color: white;
    padding: 1.5rem;
    border-radius: 0.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .btn-primary-custom {
    background-color: var(--primary-color);
    color: var(--accent-color);
    border: none;
    transition: all 0.3s;
    }
    
    .btn-primary-custom:hover {
    background-color: var(--hover-color);
    transform: translateY(-2px);
    }
    
    .table-container {
    background-color: white;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    }
    
    .table thead {
    background-color: var(--primary-color);
    color: var(--accent-color);
    }
    
    .table-hover tbody tr:hover {
    background-color: rgba(56, 102, 65, 0.05);
    }
    
    .action-btn {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    }
    
    .badge-admin {
    background-color: #6f42c1;
    color: white;
    }
    
    .badge-warga {
    background-color: #20c997;
    color: white;
    }
    
    /* Responsive table */
    @media (max-width: 992px) {
    .table-responsive-md {
        overflow-x: auto;
    }
    }
    
    @media (max-width: 768px) {
    .table-responsive-sm {
        overflow-x: auto;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
    
    .table th, .table td {
        padding: 0.5rem;
    }
    }
    
    @media (max-width: 576px) {
    .container {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    .btn-sm-block {
        display: block;
        width: 100%;
        margin-bottom: 10px;
    }
    }
    
    .alert-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1050;
    max-width: 400px;
    }
    
    .pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    }
</style>
</head>
<body>
<div class="container py-4">
    <!-- Header -->
    <div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="page-title mb-0"><i class="fas fa-users me-2"></i>Data Officer</h1>
        <a class="btn btn-light" href="{{ route('officer-create') }}">
        <i class="fas fa-plus-circle me-1"></i> Tambah Officer
        </a>
    </div>
    </div>

    <!-- Alert Messages -->
    <div class="alert-container">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class="fas fa-exclamation-circle me-1"></i> Error!</strong>
        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><i class="fas fa-check-circle me-1"></i> Sukses!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    </div>

    <!-- Table -->
    <div class="table-container">
    <div class="table-responsive-md">
        <table class="table table-hover table-bordered mb-0">
        <thead class="table-dark">
            <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($officer as $item)
            <tr>
            <td scope="row">{{ $loop->iteration }}</td>
            <td>{{ $item->user->name }}</td>
            <td class="text-center">
                <a class="btn btn-sm btn-danger" href="{{route('officer-delete',Crypt::encrypt($item->id))}}" onclick="return confirm('Hapus data ini?')" title="Hapus Warga">
                <i class="fa-solid fa-trash"></i>
                </a>
            </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Auto close alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
        const bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
        }, 5000);
    });
    });
</script>
</body>
</html>
@endsection

{{-- @extends('Administrator.template')
@section('content')
    <div class="container">
        <h1>Officer</h1>
    </div>
    <div class="container mt-3">
        <a class="btn" style="background-color: #386641; color: #FED16A" href="{{route('officer-create')}}">Tambah Officer</a>
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>Nama Officer</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            @foreach ($officer as $item)
            <tbody>
                <tr>
                    <td scope="row">{{ $item->id }}</td>
                    <td>{{$item->user->name}}</td>
                    <td>
                        <a class="btn btn-warning" href="{{route('officer-edit', Crypt::encrypt($item->id))}}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a class="btn btn-danger" href="{{route('officer-delete',Crypt::encrypt($item->id))}}" onclick="return confirm('Hapus data ini?')">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
@endsection --}}
