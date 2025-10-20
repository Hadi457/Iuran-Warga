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
    
    .badge-admin {
        background-color: #6f42c1;
    }
    
    .badge-warga {
        background-color: #20c997;
    }
</style>

<div class="container py-4">
    <!-- Header -->
    <div class="page-header p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h1 class="h3 mb-3 mb-md-0">
                <i class="fas fa-users me-2"></i>Data Warga
            </h1>
            <a class="btn btn-light" href="#" data-bs-toggle="modal" data-bs-target="#tambahModal">
                <i class="fas fa-plus-circle me-1"></i> Tambah Payment
            </a>
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
                        <th scope="col">NIK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col" class="d-none d-md-table-cell">Alamat</th>
                        <th scope="col" class="d-none d-sm-table-cell">No. Telepon</th>
                        <th scope="col">Level</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($warga as $item)
                    <tr>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->user->username }}</td>
                        <td class="d-none d-md-table-cell">{{ Str::limit($item->addres, 20) }}</td>
                        <td class="d-none d-sm-table-cell">{{ $item->number_handphone }}</td>
                        <td>
                            <span class="badge rounded-pill {{ $item->user->level == 'Admin' ? 'badge-admin' : 'badge-warga' }}">
                                {{ $item->user->level }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-info" href="{{ route('payments.detail', $item->id) }}" 
                                title="Detail Payment">
                                <i class="fas fa-circle-info text-white"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
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