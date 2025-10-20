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
    
    .badge-admin {
        background-color: #6f42c1;
    }
    
    .badge-warga {
        background-color: #20c997;
    }
</style>

<div class="container py-4">
    <!-- Header -->
    <div class="page-header p-4 mb-3">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h1 class="h3 mb-3 mb-md-0">
                <i class="fas fa-users me-2"></i>Data Warga
            </h1>
            <div class="d-flex gap-2 flex-wrap">
                <a class="btn btn-light" href="{{ route('export') }}">
                    <i class="fas fa-download me-1"></i> Download
                </a>
                <a class="btn btn-light" href="#" data-bs-toggle="modal" data-bs-target="#tambahModal">
                    <i class="fas fa-plus-circle me-1"></i> Tambah Warga
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
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
        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
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
                            <div class="btn-group btn-group-sm" role="group">
                                <a class="btn btn-warning" 
                                   href="#" data-bs-toggle="modal" data-bs-target="#editModal{{$item->id}}" 
                                   title="Edit Warga">
                                    <i class="fas fa-pen-to-square"></i>
                                </a>
                                <a class="btn btn-danger" 
                                   href="{{ route('warga-delete', Crypt::encrypt($item->id)) }}" 
                                   onclick="return confirm('Hapus data ini?')" 
                                   title="Hapus Warga">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
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
    
    @foreach ($warga as $item)
        <div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" aria-labelledby="editModalLabel{{$item->id}}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content p-4">
                    <div class="modal-header mb-3">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Warga</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('warga-update', Crypt::encrypt($item->id)) }}" method="POST" id="wargaForm">
                        @csrf
                        
                        <div class="row">
                            <!-- Nama -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="name" class="form-control" 
                                        value="{{ $item->name }}" placeholder="Masukkan nama lengkap" required>
                                </div>
                            </div>

                            <!-- NIK -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">NIK <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    <input type="text" name="nik" class="form-control" 
                                        value="{{ $item->nik }}" placeholder="Masukkan NIK" required
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
                                        value="{{ $item->user->username }}" placeholder="Masukkan username" required>
                                </div>
                            </div>

                            <!-- No. Telepon -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">No. Telepon <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" name="number_handphone" class="form-control" 
                                        value="{{ $item->number_handphone }}" placeholder="Masukkan nomor telepon" required
                                        oninput="this.value = this.value.replace(/[^0-9+]/g, '');">
                                </div>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Alamat<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-home"></i></span>
                                <input type="text" name="addres" class="form-control" 
                                    placeholder="Masukkan alamat lengkap" value="{{ $item->addres }}" required></input>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Password -->
                            <div class="col mb-3">
                                <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" id="password" class="form-control" 
                                        placeholder="Masukkan password">
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
    @endforeach
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