@extends('Administrator.template')
@section('content')
<style>
    :root {
        --primary-color: #386641;
        --accent-color: #FED16A;
        --hover-color: #2c4a32;
        --text-color: #ecf0f1;
    }
    
    .page-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--hover-color) 100%);
        color: white;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container py-4">
    <!-- Header -->
    <div class="page-header p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h1 class="h3 mb-0">
                <i class="fas fa-users me-2"></i>Anggota Iuran
            </h1>
        </div>
    </div>

    <!-- Alert Messages -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex">
                <i class="fas fa-exclamation-circle me-2 mt-1"></i>
                <div>
                    <strong>Error!</strong>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex">
                <i class="fas fa-check-circle me-2 mt-1"></i>
                <div>
                    <strong>Sukses!</strong> {{ session('success') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Table -->
    <div class="table-container">
        <div class="table-responsive">
            <table id="example" class="table w-100 table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Periode</th>
                        <th scope="col">Sisa Periode</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($anggotaiuran as $item)
                    <tr>
                        <td class="text-center" scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $item->member->name ?? '-' }}</td>
                        <td>{{ $item->duesCategory->period }}</td>
                        <td>{{ $item->sisa_periode }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    new DataTable('#example',{
        responsive: true
    });

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
@endsection