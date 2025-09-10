@extends('Administrator.template')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h1 class="page-title mb-0"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</h1>
            <div class="d-flex align-items-center">
                <span class="badge bg-light text-dark me-2">
                    <i class="fas fa-calendar me-1"></i>
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </span>
                <span class="badge bg-light text-dark">
                    <i class="fas fa-clock me-1"></i>
                    <span id="current-time">{{ \Carbon\Carbon::now()->format('H:i:s') }}</span>
                </span>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <!-- Data Warga Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card card-1">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="stats-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stats-info text-end">
                            <h2 class="stats-value">{{ $users->count() }}</h2>
                            <p class="stats-label">Data Warga</p>
                        </div>
                    </div>
                    <div class="stats-footer mt-3">
                        <small><i class="fas fa-history me-1"></i> Updated just now</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Kas Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card card-2">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="stats-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="stats-info text-end">
                            <h2 class="stats-value">Rp {{ number_format($payment->sum('nominal'), 0, ',', '.') }}</h2>
                            <p class="stats-label">Total Kas</p>
                        </div>
                    </div>
                    <div class="stats-footer mt-3">
                        <small><i class="fas fa-history me-1"></i> Updated just now</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Iuran Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card card-3">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="stats-icon">
                            <i class="fas fa-list-alt"></i>
                        </div>
                        <div class="stats-info text-end">
                            <h2 class="stats-value">{{ $dues->count() ?? 0 }}</h2>
                            <p class="stats-label">Jenis Iuran</p>
                        </div>
                    </div>
                    <div class="stats-footer mt-3">
                        <small><i class="fas fa-history me-1"></i> Updated just now</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Officer Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card card-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="stats-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="stats-info text-end">
                            <h2 class="stats-value">{{ $officers->count() ?? 0 }}</h2>
                            <p class="stats-label">Petugas</p>
                        </div>
                    </div>
                    <div class="stats-footer mt-3">
                        <small><i class="fas fa-history me-1"></i> Updated just now</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts & Additional Info -->
    <div class="row g-4">
        <!-- Recent Payments -->
        <div class="col-xl-6 col-lg-12">
            <div class="card h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0"><i class="fas fa-history me-2"></i>Pembayaran Terbaru</h5>
                </div>
                <div class="card-body">
                    @if($recentPayments && $recentPayments->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentPayments->take(5) as $payment)
                                <tr>
                                    <td>{{ $payment->member->name ?? 'N/A' }}</td>
                                    <td>Rp {{ number_format($payment->nominal, 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d/m/Y') }}</td>
                                    <td><span class="badge bg-success">Berhasil</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada data pembayaran</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-xl-6 col-lg-12">
            <div class="card h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0"><i class="fas fa-bolt me-2"></i>Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="{{ route('payments.create') }}" class="btn btn-action btn-primary w-100 text-start">
                                <i class="fas fa-plus-circle me-2"></i>
                                <div>
                                    <h6 class="mb-0">Tambah Payment</h6>
                                    <small>Input pembayaran baru</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('iuran-create') }}" class="btn btn-action btn-success w-100 text-start">
                                <i class="fas fa-list-alt me-2"></i>
                                <div>
                                    <h6 class="mb-0">Buat Iuran</h6>
                                    <small>Buat kategori iuran</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('warga-create') }}" class="btn btn-action btn-info w-100 text-start">
                                <i class="fas fa-user-plus me-2"></i>
                                <div>
                                    <h6 class="mb-0">Tambah Warga</h6>
                                    <small>Registrasi warga baru</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('officer-create') }}" class="btn btn-action btn-warning w-100 text-start">
                                <i class="fas fa-user-tie me-2"></i>
                                <div>
                                    <h6 class="mb-0">Tambah Officer</h6>
                                    <small>Assign peran officer</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .page-header {
        background: linear-gradient(135deg, #386641 0%, #2c4a32 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .page-title {
        font-weight: 700;
        font-size: 1.8rem;
    }
    
    .stats-card {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
    }
    
    .stats-card.card-1 {
        background: linear-gradient(135deg, #386641 0%, #2c4a32 100%);
    }
    
    .stats-card.card-2 {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    }
    
    .stats-card.card-3 {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    }
    
    .stats-card.card-4 {
        background: linear-gradient(135deg, #6f42c1 0%, #5a36a9 100%);
    }
    
    .stats-icon {
        font-size: 2.5rem;
        color: rgba(255, 255, 255, 0.9);
    }
    
    .stats-value {
        font-size: 2.2rem;
        font-weight: 700;
        color: #FED16A;
        margin-bottom: 0.2rem;
    }
    
    .stats-label {
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
        margin-bottom: 0;
    }
    
    .stats-footer {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.8rem;
    }
    
    .btn-action {
        padding: 1rem;
        border-radius: 0.5rem;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
        text-decoration: none;
        color: #333;
    }
    
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        color: #333;
    }
    
    .card {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
        border-bottom: 1px solid #f8f9fa;
        background-color: white;
    }
    
    /* Responsive styles */
    @media (max-width: 768px) {
        .page-header {
            padding: 1rem;
        }
        
        .page-title {
            font-size: 1.5rem;
        }
        
        .stats-value {
            font-size: 1.8rem;
        }
        
        .stats-icon {
            font-size: 2rem;
        }
        
        .btn-action {
            padding: 0.75rem;
        }
    }
    
    @media (max-width: 576px) {
        .stats-value {
            font-size: 1.5rem;
        }
        
        .stats-label {
            font-size: 0.9rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update current time every second
        function updateTime() {
            const now = new Date();
            const timeElement = document.getElementById('current-time');
            if (timeElement) {
                timeElement.textContent = now.toLocaleTimeString('id-ID');
            }
        }
        
        setInterval(updateTime, 1000);
        
        // Add animation to stats cards
        const statsCards = document.querySelectorAll('.stats-card');
        statsCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>
@endsection