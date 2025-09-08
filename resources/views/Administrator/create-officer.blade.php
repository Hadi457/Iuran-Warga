@extends('Administrator.template')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h3 class="page-title mb-0"><i class="fas fa-user-tie me-2"></i>Tambah Officer</h3>
            <a href="{{ url()->previous() }}" class="btn btn-outline-light">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Form Container -->
    <div class="row justify-content-center">
        <div class="col">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="card-title mb-0"><i class="fas fa-user-plus me-2"></i>Form Tambah Officer</h5>
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

                        <!-- Informasi Officer -->
                        <div class="alert alert-info">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle me-2"></i>
                                <h6 class="mb-0">Informasi Officer</h6>
                            </div>
                            <hr class="my-2">
                            <p class="mb-0 small">
                                Officer akan memiliki akses tambahan untuk mengelola data iuran dan pembayaran. 
                                Pastikan memilih warga yang tepat untuk peran ini.
                            </p>
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
    
    .form-select:focus {
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
    
    .list-group-item {
        border-color: #f8f9fa;
        padding: 1rem 1.25rem;
    }
    
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
    
    /* Searchable select enhancement */
    .form-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
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
    }
</style>
@endsection

{{-- @extends('Administrator.template')
@section('content')
    <div class="container">
        <h1>Tambah Officer</h1>
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
        <div class="container mt-3">
            <div class="card-body">
                <form action="{{ route('officer-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <select name="iduser" class="form-control mb-3">
                        <option value="">Pilih Warga</option>
                        @foreach ($members as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn" style="width: 100%; background-color: #FED16A; color: #386641">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection --}}