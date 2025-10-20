@extends('Administrator.template')
@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #386641 0%, #2c4a32 100%);
    }
</style>
<div class="container py-4">
    <!-- Header -->
    <div class="page-header p-4 mb-4 rounded-3">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h1 class="h3 mb-3 mb-md-0 text-white">
                <i class="fas fa-list-alt me-2"></i>Kategori Iuran
            </h1>
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

    <!-- Table Container -->
    <div class="table-container">
        <div class="table-responsive">
            <table id="example" class="table w-100 table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Periode</th>
                        <th scope="col">Nominal</th>
                        <th scope="col" class="d-none d-md-table-cell">Dibuat Pada</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dues as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->period }}</td>
                        <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                        <td class="d-none d-md-table-cell">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y H:i') }}</td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <a class="btn btn-warning" 
                                   href="" data-bs-toggle="modal" data-bs-target="#editModal{{$item->id}}" 
                                   title="Edit">
                                    <i class="fas fa-pen-to-square"></i>
                                </a>
                                <a class="btn btn-danger" 
                                   href="{{ route('iuran-delete', Crypt::encrypt($item->id)) }}" 
                                   onclick="return confirm('Hapus data ini?')" 
                                   title="Hapus">
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

    @foreach ($dues as $item)
        <div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" aria-labelledby="editModalLabel{{$item->id}}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content p-4">
                    <div class="modal-header mb-3">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Kategori Iuran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('iuran-update', Crypt::encrypt($item->id)) }}) }}" method="POST" id="iuranForm">
                        @csrf
                        
                        <!-- Periode Selection -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Periode Iuran <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-calendar-alt text-muted"></i>
                                </span>
                                <select name="period" class="form-select form-select" required>
                                    <option value="bulanan" {{ $item->period == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                                    <option value="tahunan" {{ $item->period == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                                    <option value="mingguan" {{ $item->period == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
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
                                    value="{{ $item->nominal }}" placeholder="Masukkan nominal" required
                                    oninput="formatCurrency(this)">
                            </div>
                            <div class="form-text">
                                Masukkan nominal iuran tanpa titik atau koma
                            </div>
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
    @endforeach

    <!-- Empty State -->
    @if($dues->count() == 0)
    <div class="text-center py-5">
        <i class="fas fa-list-alt fa-4x text-muted mb-3"></i>
        <h4 class="text-muted">Belum ada data kategori iuran</h4>
        <p class="text-muted">Mulai dengan menambahkan data kategori iuran baru</p>
        <a class="btn btn-primary mt-2" href="{{ route('iuran-create') }}">
            <i class="fas fa-plus-circle me-1"></i> Tambah Data
        </a>
    </div>
    @endif
</div>

<script>
    new DataTable('#example',{
        responsive: true
    });
    document.addEventListener('DOMContentLoaded', function() {
        // Add confirmation for delete action
        const deleteButtons = document.querySelectorAll('a[onclick*="confirm"]');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection