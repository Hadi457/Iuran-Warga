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
                <i class="fas fa-users me-2"></i>Detail Payment
            </h1>
        </div>
    </div>

    <!-- Member Info Card -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted small">Nama Warga:</p>
                    <h6 class="fw-semibold mb-0">{{ $member->name }}</h6>
                </div>
                
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted small">Periode Iuran:</p>
                    <h6 class="fw-semibold mb-0 text-capitalize">{{ $payment->period }}</h6>
                </div>
            </div>
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
    
    @if (session('pesan'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex">
                <i class="fas fa-check-circle me-2 mt-1"></i>
                <div>
                    <strong>Sukses!</strong> {{ session('pesan') }}
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
                        <th>Petugas</th>
                        <th>Nominal</th>
                        <th>Tanggal Bayar</th>
                        <th>Periode Tagihan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $p)
                    <tr>
                        <td>{{ $p->officer?->user?->name ?? '-' }}</td>
                        <td>Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
                        <td>{{ date('d-m-Y', strtotime($p->payment_date)) }}</td>
                        <td>{{ $p->periode_tagihan }}</td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-danger" 
                               href="{{ route('payments.destroy', Crypt::encrypt($p->id)) }}" 
                               onclick="return confirm('Hapus data ini?')"
                               title="Hapus Payment">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
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