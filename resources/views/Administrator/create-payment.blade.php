@extends('Administrator.template')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="page-title mb-0"><i class="fas fa-money-bill-wave me-2"></i>Tambah Payment</h3>
            <a href="{{ url()->previous() }}" class="btn btn-outline-light">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Form Container -->
    <div class="card shadow border-0">
        <div class="card-body p-4">
            @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <h5 class="alert-heading mb-0">Terjadi Kesalahan!</h5>
                </div>
                <hr>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

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

                <!-- Kategori Iuran Selection -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Kategori Iuran <span class="text-danger">*</span></label>
                    <select name="dues_category_id" id="duesCategory" class="form-select form-select" required>
                        <option value="" selected disabled>Pilih Kategori Iuran</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}" data-nominal="{{ $c->nominal }}" {{ old('dues_category_id') == $c->id ? 'selected' : '' }}>
                                {{ $c->name }} - Rp {{ number_format($c->nominal) }} / {{ $c->period }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-text">Pilih kategori iuran yang akan dibayar</div>
                </div>

                <!-- Nominal Total -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Nominal Total <span class="text-danger">*</span></label>
                    <div class="input-group input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="nominal" id="nominal" class="form-control" 
                               value="{{ old('nominal') }}" placeholder="Masukkan nominal total" required>
                    </div>
                    <div class="form-text">
                        Nominal default akan terisi otomatis sesuai kategori yang dipilih. 
                        Anda dapat mengubahnya secara manual jika diperlukan.
                    </div>
                </div>

                <!-- Informasi Kategori (akan terisi otomatis) -->
                <div class="alert alert-info" id="categoryInfo" style="display: none;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle me-2"></i>
                        <h6 class="mb-0">Informasi Kategori</h6>
                    </div>
                    <hr class="my-2">
                    <div id="infoContent">
                        <!-- Informasi akan diisi oleh JavaScript -->
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <button type="reset" class="btn btn-outline-secondary btn">
                        <i class="fas fa-undo me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-success btn">
                        <i class="fas fa-save me-1"></i> Simpan Payment
                    </button>
                </div>
            </form>
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
    
    .form-label {
        color: #386641;
    }
    
    .form-select:focus, .form-control:focus {
        border-color: #386641;
        box-shadow: 0 0 0 0.25rem rgba(56, 102, 65, 0.25);
    }
    
    .btn-success {
        background-color: #386641;
        border-color: #386641;
    }
    
    .btn-success:hover {
        background-color: #2c4a32;
        border-color: #2c4a32;
    }
    
    @media (max-width: 768px) {
        .btn-lg {
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }
        
        .d-md-flex {
            flex-direction: column;
        }
        
        .gap-2 {
            gap: 1rem !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const duesCategory = document.getElementById('duesCategory');
        const nominalInput = document.getElementById('nominal');
        const categoryInfo = document.getElementById('categoryInfo');
        const infoContent = document.getElementById('infoContent');
        
        // Update nominal when category changes
        duesCategory.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const nominalValue = selectedOption.getAttribute('data-nominal');
            
            if (nominalValue) {
                nominalInput.value = nominalValue;
                
                // Show category info
                const categoryName = selectedOption.text.split(' - ')[0];
                const period = selectedOption.text.split(' / ')[1];
                
                infoContent.innerHTML = `
                    <p class="mb-1"><strong>Kategori:</strong> ${categoryName}</p>
                    <p class="mb-1"><strong>Nominal Standar:</strong> Rp ${formatRupiah(nominalValue)}</p>
                    <p class="mb-0"><strong>Periode:</strong> ${period}</p>
                `;
                
                categoryInfo.style.display = 'block';
            } else {
                categoryInfo.style.display = 'none';
            }
        });
        
        // Trigger change event if there's already a selected value (after validation error)
        if (duesCategory.value) {
            duesCategory.dispatchEvent(new Event('change'));
        }
        
        // Format nominal input on blur
        nominalInput.addEventListener('blur', function() {
            if (this.value) {
                this.value = formatRupiah(this.value, false);
            }
        });
        
        nominalInput.addEventListener('focus', function() {
            this.value = this.value.replace(/[^\d]/g, '');
        });
        
        // Function to format currency
        function formatRupiah(amount, prefix = true) {
            const numberString = amount.toString().replace(/[^\d]/g, '');
            const number = parseInt(numberString);
            
            if (isNaN(number)) return '';
            
            if (prefix) {
                return 'Rp ' + number.toLocaleString('id-ID');
            } else {
                return number.toLocaleString('id-ID');
            }
        }
        
        // Format nominal on page load if there's a value
        if (nominalInput.value) {
            nominalInput.value = formatRupiah(nominalInput.value, false);
        }
    });
</script>
@endsection