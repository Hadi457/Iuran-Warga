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
    }
    
    .stats-card {
        transition: transform 0.3s ease;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
    }
    
    .stats-value {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.2rem;
        color: var(--accent-color);
    }
    
    .stats-label {
        font-weight: 500;
    }
    
    .stats-footer {
        font-size: 0.8rem;
        opacity: 0.8;
    }
    
    /* Custom Background Colors */
    .custom-primary {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--hover-color) 100%);
    }
    
    .custom-success {
        background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
    }
    
    .custom-info {
        background: linear-gradient(135deg, #17a2b8 0%, #117a8b 100%);
    }
    
    .custom-warning {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
    }
    
    /* Custom Outline Buttons */
    .btn-action {
        border: 2px solid;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }
    
    .custom-outline-primary {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }
    
    .custom-outline-primary:hover {
        background-color: var(--primary-color);
        color: white;
    }
    
    .custom-outline-success {
        border-color: #28a745;
        color: #28a745;
    }
    
    .custom-outline-success:hover {
        background-color: #28a745;
        color: white;
    }
    
    .custom-outline-info {
        border-color: #17a2b8;
        color: #17a2b8;
    }
    
    .custom-outline-info:hover {
        background-color: #17a2b8;
        color: white;
    }
    
    .custom-outline-warning {
        border-color: #ffc107;
        color: #ffc107;
    }
    
    .custom-outline-warning:hover {
        background-color: #ffc107;
        color: #212529;
    }
</style>

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="page-header p-4 mb-4 rounded-3">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h1 class="h2 mb-3 mb-md-0 text-white">
                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
            </h1>
            <div class="d-flex align-items-center flex-wrap gap-2">
                <span class="badge bg-light text-dark">
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
            <div class="card stats-card border-0 shadow-sm h-100">
                <div class="card-body text-white custom-primary rounded-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="stats-icon">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <div class="stats-info text-end">
                            <h2 class="stats-value">{{ $users->count() }}</h2>
                            <p class="stats-label mb-0">Data Warga</p>
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
            <div class="card stats-card border-0 shadow-sm h-100">
                <div class="card-body text-white custom-success rounded-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="stats-icon">
                            <i class="fas fa-money-bill-wave fa-2x"></i>
                        </div>
                        <div class="stats-info text-end">
                            <h2 class="stats-value">Rp {{ number_format($payment->sum('nominal'), 0, ',', '.') }}</h2>
                            <p class="stats-label mb-0">Total Kas</p>
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
            <div class="card stats-card border-0 shadow-sm h-100">
                <div class="card-body text-white custom-info rounded-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="stats-icon">
                            <i class="fas fa-list-alt fa-2x"></i>
                        </div>
                        <div class="stats-info text-end">
                            <h2 class="stats-value">{{ $dues->count() ?? 0 }}</h2>
                            <p class="stats-label mb-0">Jenis Iuran</p>
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
            <div class="card stats-card border-0 shadow-sm h-100">
                <div class="card-body text-white custom-warning rounded-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="stats-icon">
                            <i class="fas fa-user-tie fa-2x"></i>
                        </div>
                        <div class="stats-info text-end">
                            <h2 class="stats-value">{{ $officers->count() ?? 0 }}</h2>
                            <p class="stats-label mb-0">Petugas</p>
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
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="card-title mb-0"><i class="fas fa-history me-2"></i>Pembayaran Terbaru</h5>
                </div>
                <div class="card-body">
                    @if($recentPayments && $recentPayments->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
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
                                    <td><span class="badge custom-success">Berhasil</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                        <p class="text-muted mb-0">Belum ada data pembayaran</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-xl-6 col-lg-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="card-title mb-0"><i class="fas fa-bolt me-2"></i>Aksi Cepat</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4 mb-4">
                        <div class="modal fade" id="tambahpaymentModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content p-4">
                                    <div class="modal-header mb-3">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Payment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('payments.store') }}" method="POST" id="paymentForm">
                                        @csrf
                                        
                                        <!-- Warga Selection -->
                                        <div class="mb-4">
                                            <label class="form-label fw-semibold">Warga <span class="text-danger">*</span></label>
                                            <select name="member_id" class="form-select form-select" required>
                                                <option value="" selected disabled>Pilih Warga</option>
                                                @foreach($members as $m)
                                                    <option value="{{ $m->id }}" {{ old('member_id') == $m->id ? 'selected' : '' }}>
                                                        {{ $m->name }} ({{ $m->nik }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="form-text">Pilih warga yang melakukan pembayaran</div>
                                        </div>

                                        <!-- Nominal Total -->
                                        <div class="mb-4">
                                            <label class="form-label fw-semibold">Nominal Total <span class="text-danger">*</span></label>
                                            <div class="input-group input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" name="nominal" id="nominal" class="form-control" 
                                                    value="{{ old('nominal') }}" placeholder="Masukkan nominal total" required
                                                    oninput="validatePayment()">
                                            </div>
                                            <div class="form-text">
                                                Nominal default akan terisi otomatis sesuai kategori yang dipilih. 
                                                Anda dapat mengubahnya secara manual jika diperlukan.
                                            </div>
                                        </div>

                                        <!-- Payment Validation Info -->
                                        <div class="alert alert-warning" id="paymentValidation" style="display: none;">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-exclamation-triangle me-2"></i>
                                                <h6 class="mb-0">Validasi Pembayaran</h6>
                                            </div>
                                            <hr class="my-2">
                                            <div id="validationContent"></div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                            <button type="reset" class="btn btn-outline-secondary btn" onclick="resetValidation()">
                                                <i class="fas fa-undo me-1"></i> Reset
                                            </button>
                                            <button type="submit" class="btn btn-success btn" id="submitButton">
                                                <i class="fas fa-save me-1"></i> Simpan Payment
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#tambahpaymentModal" class="btn btn-action custom-outline-primary w-100 h-100 text-start p-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-plus-circle fa-2x me-3"></i>
                                    <div>
                                        <h6 class="mb-1">Tambah Payment</h6>
                                        <small class="">Input pembayaran baru</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        {{-- <div class="col-md-6">
                            <a href="{{ route('iuran-create') }}" class="btn btn-action custom-outline-success w-100 h-100 text-start p-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-list-alt fa-2x me-3"></i>
                                    <div>
                                        <h6 class="mb-1">Buat Iuran</h6>
                                        <small class="">Buat kategori iuran</small>
                                    </div>
                                </div>
                            </a>
                        </div> --}}
                    </div>
                    <div class="row g-4">
                        <div class="modal fade" id="wargatambahModal" tabindex="-1" aria-labelledby="wargatambahModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content p-4">
                                    <div class="modal-header mb-3">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Warga</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('warga-store') }}" method="POST" id="wargaForm">
                                        @csrf
                                        <div class="row">
                                            <!-- Nama -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    <input type="text" name="name" class="form-control" 
                                                        value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                                                </div>
                                            </div>

                                            <!-- NIK -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-semibold">NIK <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                                    <input type="text" name="nik" class="form-control" 
                                                        value="{{ old('nik') }}" placeholder="Masukkan NIK" required
                                                        maxlength="16" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                </div>
                                                <div class="form-text">NIK harus 16 digit angka</div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Username -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-semibold">Username <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                                    <input type="text" name="username" class="form-control" 
                                                        value="{{ old('username') }}" placeholder="Masukkan username" required>
                                                </div>
                                            </div>

                                            <!-- No. Telepon -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-semibold">No. Telepon <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                    <input type="text" name="number_handphone" class="form-control" 
                                                        value="{{ old('number_handphone') }}" placeholder="Masukkan nomor telepon" required
                                                        oninput="this.value = this.value.replace(/[^0-9+]/g, '');">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Alamat -->
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Alamat <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-home"></i></span>
                                                <input type="text" name="addres" class="form-control" 
                                                        placeholder="Masukkan alamat" required>{{ old('addres') }}</input>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Password -->
                                            <div class="col mb-3">
                                                <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                    <input type="password" name="password" id="password" class="form-control" 
                                                        placeholder="Masukkan password" required>
                                                    <button class="btn btn-outline-secondary toggle-password" type="button">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                                <div class="form-text">Minimal 8 karakter</div>
                                            </div>
                                            <!-- Kategori Iuran Selection -->
                                            <div class="mb-4">
                                                <label class="form-label fw-semibold">Kategori Iuran <span class="text-danger">*</span></label>
                                                <select name="dues_category_id" id="duesCategory" class="form-select form-select" required>
                                                    <option value="" selected disabled>Pilih Kategori Iuran</option>
                                                    @foreach($categories as $c)
                                                        <option value="{{ $c->id }}" data-nominal="{{ $c->nominal }}" data-period="{{ $c->period }}" {{ old('dues_category_id') == $c->id ? 'selected' : '' }}>
                                                            {{ $c->name }} - Rp {{ number_format($c->nominal) }} / {{ $c->period }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="form-text">Pilih kategori iuran yang akan dibayar</div>
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button type="reset" class="btn btn-outline-secondary me-md-2">
                                                <i class="fas fa-undo me-1"></i> Reset
                                            </button>
                                            <button type="submit" class="btn btn-success btn">
                                                <i class="fas fa-save me-1"></i> Simpan Data
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#wargatambahModal" class="btn btn-action custom-outline-info w-100 h-100 text-start p-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-plus fa-2x me-3"></i>
                                    <div>
                                        <h6 class="mb-1">Tambah Warga</h6>
                                        <small class="">Registrasi warga baru</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="modal fade" id="officertambahModal" tabindex="-1" aria-labelledby="officertambahModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content p-4">
                                    <div class="modal-header mb-3">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Officer</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('officer-store') }}" method="POST" id="officerForm">
                                        @csrf
                                        <!-- Warga Selection -->
                                        <div class="mb-4">
                                            <label class="form-label fw-semibold">Pilih Warga <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="fas fa-search text-muted"></i>
                                                </span>
                                                <select name="iduser" class="form-select form-select" required>
                                                    <option value="" selected disabled>-- Pilih Nama Warga --</option>
                                                    @foreach ($members as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-text">
                                                Pilih warga yang akan dijadikan sebagai officer
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                            <button type="reset" class="btn btn-outline-secondary me-md-2">
                                                <i class="fas fa-undo me-1"></i> Reset
                                            </button>
                                            <button type="submit" class="btn btn-success btn">
                                                <i class="fas fa-save me-1"></i> Simpan Officer
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#officertambahModal" class="btn btn-action custom-outline-warning w-100 h-100 text-start p-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-tie fa-2x me-3"></i>
                                    <div>
                                        <h6 class="mb-1">Tambah Officer</h6>
                                        <small class="">Assign peran officer</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
    });
</script>
@endsection