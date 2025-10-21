@extends('Administrator.template')
@section('content')

<style>
.page-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--hover-color) 100%);
    color: white;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.card {
    border: none;
    border-radius: 1rem;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.2s ease;
}
.card:hover {
    transform: translateY(-5px);
}
.card img {
    height: 180px;
    object-fit: cover;
}
</style>

<div class="py-4">
    <div class="page-header p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h1 class="h3 mb-3 mb-md-0">
                <i class="fas fa-newspaper me-2"></i>Data Berita
            </h1>
            <a class="btn btn-light" href="#" data-bs-toggle="modal" data-bs-target="#tambahModal">
                <i class="fas fa-plus-circle me-1"></i> Tambah Berita
            </a>
        </div>
    </div>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Grid Card --}}
    <div class="row g-4">
        @forelse($activities as $item)
        <div class="col-md-4 col-lg-3">
            <div class="card">
                @if($item->image)
                    <img src="{{ asset($item->image) }}" class="card-img-top" alt="{{ $item->name }}">
                @else
                    <img src="{{ asset('noimage.png') }}" class="card-img-top" alt="No Image">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $item->name }}</h5>
                    <p class="card-text text-truncate">{{ $item->description }}</p>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-sm btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $item->id }}">
                            <i class="fas fa-edit"></i> Edit
                        </button>

                        <form action="{{ route('activity-destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus berita ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Edit --}}
        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content p-4">
                    <div class="modal-header mb-3">
                        <h5 class="modal-title">Edit Berita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('activity-update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name{{ $item->id }}" class="form-label">Judul Berita</label>
                            <input type="text" class="form-control" id="name{{ $item->id }}" name="name" value="{{ $item->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar Saat Ini</label><br>
                            @if($item->image)
                                <img src="{{ asset($item->image) }}" alt="Gambar Berita" class="img-thumbnail mb-2" style="width: 100px; height: 100px;">
                            @else
                                <p>Tidak ada gambar</p>
                            @endif
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="description{{ $item->id }}" class="form-label">Isi Berita</label>
                            <textarea class="form-control" id="description{{ $item->id }}" name="description" rows="4" required>{{ $item->description }}</textarea>
                        </div>
                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center text-muted">Belum ada berita.</p>
        @endforelse
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-4">
            <div class="modal-header mb-3">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Berita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('activity-store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Judul Berita</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Isi Berita</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>
                <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
