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

                {{-- <!-- Informasi Kategori -->
                <div class="alert alert-info" id="categoryInfo">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle me-2"></i>
                        <h6 class="mb-0">Informasi Kategori</h6>
                    </div>
                    <hr class="my-2">
                    <div id="infoContent">
                        Silakan pilih kategori iuran untuk melihat informasi detail
                    </div>
                </div> --}}

                <!-- Payment Validation Info -->
                <div class="alert alert-warning" id="paymentValidation" style="display: none;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <h6 class="mb-0">Validasi Pembayaran</h6>
                    </div>
                    <hr class="my-2">
                    <div id="validationContent"></div>
                </div>

                <!-- Change Handling (akan muncul jika ada kelebihan pembayaran) -->
                <div class="card mb-4" id="changeSection" style="display: none;">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="fas fa-exchange-alt me-2"></i>Penanganan Kelebihan Pembayaran</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="change_handling" id="returnChange" value="return" checked>
                                <label class="form-check-label" for="returnChange">
                                    Kembalikan kelebihan pembayaran (Rp <span id="changeAmount">0</span>)
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="change_handling" id="saveAsDeposit" value="deposit">
                                <label class="form-check-label" for="saveAsDeposit">
                                    Simpan sebagai deposit untuk pembayaran berikutnya
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="change_handling" id="payNextPeriod" value="next_period">
                                <label class="form-check-label" for="payNextPeriod">
                                    Bayarkan untuk periode berikutnya
                                </label>
                            </div>
                        </div>
                    </div>
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
    
    #changeSection {
        border: 2px solid #ffc107;
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
        const paymentValidation = document.getElementById('paymentValidation');
        const validationContent = document.getElementById('validationContent');
        const changeSection = document.getElementById('changeSection');
        const changeAmount = document.getElementById('changeAmount');
        const submitButton = document.getElementById('submitButton');
        
        let requiredNominal = 0;
        let paymentPeriod = '';
        
        // Update info when category changes
        duesCategory.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const nominalValue = selectedOption.getAttribute('data-nominal');
            const periodValue = selectedOption.getAttribute('data-period');
            
            requiredNominal = parseInt(nominalValue) || 0;
            paymentPeriod = periodValue || '';
            
            if (nominalValue) {
                nominalInput.value = nominalValue;
                
                infoContent.innerHTML = `
                    <p class="mb-1"><strong>Kategori:</strong> ${selectedOption.text.split(' - ')[0]}</p>
                    <p class="mb-1"><strong>Nominal Standar:</strong> Rp ${formatRupiah(nominalValue)}</p>
                    <p class="mb-0"><strong>Periode:</strong> ${periodValue}</p>
                `;
                
                categoryInfo.style.display = 'block';
                validatePayment();
            } else {
                categoryInfo.style.display = 'block';
                infoContent.innerHTML = 'Silakan pilih kategori iuran untuk melihat informasi detail';
            }
        });
        
        // Validate payment function
        window.validatePayment = function() {
            const paidAmount = parseInt(nominalInput.value) || 0;
            
            // Reset validation messages
            paymentValidation.style.display = 'none';
            changeSection.style.display = 'none';
            submitButton.disabled = false;
            
            if (paidAmount > 0 && requiredNominal > 0) {
                if (paidAmount < requiredNominal) {
                    // Kurang bayar
                    const shortage = requiredNominal - paidAmount;
                    paymentValidation.style.display = 'block';
                    validationContent.innerHTML = `
                        <div class="text-danger">
                            <p class="mb-1"><strong>Pembayaran kurang!</strong></p>
                            <p class="mb-0">Nominal yang dibayarkan kurang <strong>Rp ${formatRupiah(shortage)}</strong> dari yang seharusnya.</p>
                        </div>
                    `;
                    submitButton.disabled = true;
                } else if (paidAmount > requiredNominal) {
                    // Lebih bayar
                    const change = paidAmount - requiredNominal;
                    paymentValidation.style.display = 'block';
                    validationContent.innerHTML = `
                        <div class="text-warning">
                            <p class="mb-1"><strong>Pembayaran lebih!</strong></p>
                            <p class="mb-0">Nominal yang dibayarkan lebih <strong>Rp ${formatRupiah(change)}</strong> dari yang seharusnya.</p>
                        </div>
                    `;
                    
                    // Show change handling options
                    changeSection.style.display = 'block';
                    changeAmount.textContent = formatRupiah(change);
                    
                } else {
                    // Exact amount
                    paymentValidation.style.display = 'block';
                    validationContent.innerHTML = `
                        <div class="text-success">
                            <p class="mb-0"><strong>Pembayaran tepat!</strong> Nominal yang dibayarkan sesuai dengan yang diperlukan.</p>
                        </div>
                    `;
                }
            }
        };
        
        // Reset validation
        window.resetValidation = function() {
            paymentValidation.style.display = 'none';
            changeSection.style.display = 'none';
            submitButton.disabled = false;
            categoryInfo.style.display = 'block';
            infoContent.innerHTML = 'Silakan pilih kategori iuran untuk melihat informasi detail';
        };
        
        // Format currency function
        function formatRupiah(amount) {
            return new Intl.NumberFormat('id-ID').format(amount);
        }
        
        // Trigger change event if there's already a selected value
        if (duesCategory.value) {
            duesCategory.dispatchEvent(new Event('change'));
        }
        
        // Validate on input
        nominalInput.addEventListener('input', validatePayment);
    });
</script>
@endsection







{{-- @extends('Administrator.template')

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
        const nominalInput = document.getElementById('nominal');
        const categoryInfo = document.getElementById('categoryInfo');
        
        // Update nominal when category changes
        duesCategory.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const nominalValue = selectedOption.getAttribute('data-nominal');
            if (nominalValue) {
                nominalInput.value = nominalValue;
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
        // function formatRupiah(amount, prefix = true) {
        //     const numberString = amount.toString().replace(/[^\d]/g, '');
        //     const number = parseInt(numberString);
            
        //     if (isNaN(number)) return '';
            
        //     if (prefix) {
        //         return 'Rp ' + number.toLocaleString('id-ID');
        //     } else {
        //         return number.toLocaleString('id-ID');
        //     }
        // }
        
        // Format nominal on page load if there's a value
        // if (nominalInput.value) {
        //     nominalInput.value = formatRupiah(nominalInput.value, false);
        // }
    });
</script>
@endsection --}}








{{-- @extends('Administrator.template')

@section('content')
<div class="container mt-4">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <h3>Tambah Payment</h3>
    <form action="{{ route('payments.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Warga</label>
        <select name="member_id" class="form-control">
            @foreach($members as $m)
                <option value="{{ $m->id }}">{{ $m->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Kategori Iuran</label>
        <select name="dues_category_id" class="form-control">
            @foreach($categories as $c)
                <option value="{{ $c->id }}">{{ $c->name }} - Rp {{ number_format($c->nominal) }} / {{ $c->period }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Nominal Total</label>
        <input type="number" name="nominal" class="form-control" >
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
</form>
</div>
@endsection --}}