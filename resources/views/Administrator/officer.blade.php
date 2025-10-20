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
    <div class="page-header p-4 mb-3">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h1 class="h3 mb-3 mb-md-0">
                <i class="fas fa-users me-2"></i>Data Officer
            </h1>
            <a class="btn btn-light" href="#" data-bs-toggle="modal" data-bs-target="#tambahModal">
                <i class="fas fa-plus-circle me-1"></i> Tambah Officer
            </a>
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
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($officer as $item)
                    <tr>
                        <td scope="row" class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-danger" 
                               href="{{ route('officer-delete', Crypt::encrypt($item->id)) }}" 
                               onclick="return confirm('Hapus data ini?')" 
                               title="Hapus Officer">
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

<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
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