@extends('Administrator.template')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="page-title mb-0"><i class="fas fa-user-plus me-2"></i>Tambah Data Warga</h3>
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
                    <h5 class="card-title mb-0"><i class="fas fa-info-circle me-2"></i>Form Tambah Data Warga</h5>
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
    
    .input-group-text {
        background-color: #f8f9fa;
        border-right: none;
    }
    
    .form-control:focus {
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
    
    .toggle-password {
        border-left: none;
    }
    
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
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        const toggleButtons = document.querySelectorAll('.toggle-password');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
        // Form validation
        const form = document.getElementById('wargaForm');
        form.addEventListener('submit', function(event) {
            validatePassword();
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
        });
    });
</script>
@endsection