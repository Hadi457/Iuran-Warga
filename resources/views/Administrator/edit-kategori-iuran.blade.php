{{-- @extends('Administrator.template')
@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Validate Invalid</strong>
                <ul>
                    @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1>Edit Kategori Iuran</h1>
        <div class="container">
            <div class="card-body" >
                <form action="{{ route('iuran-update', Crypt::encrypt($dues->id)) }}" method="POST">
                    @csrf
                    <select name="period" class="form-control mb-3">
                        <option value="bulanan" {{ $dues->period == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                        <option value="tahunan" {{ $dues->period == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                        <option value="mingguan" {{ $dues->period == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                    </select>
                    <input type="text" name="nominal" class="form-control mb-3" placeholder="Nominal" value="{{ $dues->nominal }}" required>
                    <select name="status" class="form-control mb-3">
                        <option value="Aktif" {{ $dues->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Tidak Aktif" {{ $dues->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    <button type="submit" class="btn" style="width: 300px; background-color: #FED16A; color: #386641" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection --}}

@extends('Administrator.template')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h3 class="page-title mb-0"><i class="fas fa-money-bill-wave me-2"></i>Tambah Iuran</h3>
            <a href="{{ url()->previous() }}" class="btn btn-outline-light">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Form Container -->
    <div class="row justify-content-center">
        <div class="">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="card-title mb-0"><i class="fas fa-plus-circle me-2"></i>Form Tambah Iuran</h5>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <h5 class="alert-heading mb-0">Validasi Gagal</h5>
                        </div>
                        <hr>
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success mb-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-2"></i>
                            <h5 class="alert-heading mb-0">Sukses!</h5>
                        </div>
                        <hr>
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                    @endif

                    <form action="{{ route('iuran-update', Crypt::encrypt($dues->id)) }}) }}" method="POST" id="iuranForm">
                        @csrf
                        
                        <!-- Periode Selection -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Periode Iuran <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-calendar-alt text-muted"></i>
                                </span>
                                <select name="period" class="form-select form-select" required>
                                    <option value="bulanan" {{ $dues->period == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                                    <option value="tahunan" {{ $dues->period == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                                    <option value="mingguan" {{ $dues->period == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                                </select>
                            </div>
                            <div class="form-text">
                                Pilih periode pembayaran iuran
                            </div>
                        </div>

                        <!-- Nominal -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Nominal <span class="text-danger">*</span></label>
                            <div class="input-group input-group">
                                <span class="input-group-text bg-light">Rp</span>
                                <input type="text" name="nominal" id="nominal" class="form-control" 
                                    value="{{ $dues->nominal }}" placeholder="Masukkan nominal" required
                                    oninput="formatCurrency(this)">
                            </div>
                            <div class="form-text">
                                Masukkan nominal iuran tanpa titik atau koma
                            </div>
                        </div>

                        <!-- Status Selection -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Status</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-toggle-on text-muted"></i>
                                </span>
                                <select name="status" class="form-select form-select">
                                    <option value="Aktif" {{ ('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Tidak Aktif" {{ ('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="form-text">
                                Status aktif akan membuat iuran dapat digunakan
                            </div>
                        </div>

                        <!-- Informasi Iuran -->
                        <div class="alert alert-info">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle me-2"></i>
                                <h6 class="mb-0">Informasi Iuran</h6>
                            </div>
                            <hr class="my-2">
                            <p class="mb-0 small">
                                Iuran yang dibuat akan tersedia untuk dipilih saat melakukan pembayaran. 
                                Pastikan nominal dan periode sudah sesuai.
                            </p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="reset" class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-undo me-1"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-success btn">
                                <i class="fas fa-save me-1"></i> Simpan Iuran
                            </button>
                        </div>
                    </form>
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
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .page-title {
        font-weight: 700;
    }
    
    .card {
        border-radius: 0.75rem;
        border: none;
    }
    
    .card-header {
        border-top-left-radius: 0.75rem !important;
        border-top-right-radius: 0.75rem !important;
    }
    
    .form-label {
        color: #386641;
        margin-bottom: 0.5rem;
    }
    
    .form-select:focus, .form-control:focus {
        border-color: #386641;
        box-shadow: 0 0 0 0.25rem rgba(56, 102, 65, 0.25);
    }
    
    .btn-primary-custom {
        background-color: #386641;
        color: #FED16A;
        border: none;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-primary-custom:hover {
        background-color: #2c4a32;
        color: #FED16A;
        transform: translateY(-2px);
    }
    
    /* Responsive styles */
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }
        
        .d-md-flex {
            flex-direction: column;
        }
        
        .me-md-2 {
            margin-right: 0 !important;
            margin-bottom: 1rem;
        }
        
        .page-header {
            padding: 1rem;
        }
        
        .page-title {
            font-size: 1.5rem;
        }
    }
    
    @media (max-width: 576px) {
        .container {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        .btn {
            padding: 0.75rem 1rem;
        }
        
        .input-group- > .form-control,
        .input-group- > .form-select {
            padding: 0.75rem 1rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Format currency function
        function formatCurrency(input) {
            // Remove non-digit characters
            let value = input.value.replace(/[^\d]/g, '');
            
            // Format with thousand separators
            if (value.length > 0) {
                value = parseInt(value).toLocaleString('id-ID');
            }
            
            input.value = value;
        }
        
        // Handle form submission - remove formatting before submit
        const form = document.getElementById('iuranForm');
        form.addEventListener('submit', function() {
            const nominalInput = document.getElementById('nominal');
            nominalInput.value = nominalInput.value.replace(/[^\d]/g, '');
        });
        
        // Format nominal on page load if there's a value
        const nominalInput = document.getElementById('nominal');
        if (nominalInput.value) {
            formatCurrency({ value: nominalInput.value });
        }
        
        // Form validation
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                
                // Scroll to first error
                const firstInvalid = form.querySelector(':invalid');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstInvalid.focus();
                }
            }
        });
    });
</script>
@endsection
