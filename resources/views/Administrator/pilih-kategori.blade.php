@extends('Administrator.template')
@section('content')
<div class="container">
    <h4>Pilih Kategori Tagihan untuk {{ $user->name }}</h4>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('tagihan.simpan', $user->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori Iuran</label>
            <select name="kategori_id" id="kategori" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $k)
                    <option value="{{ $k->id }}">{{ ucfirst($k->period) }} - Rp{{ number_format($k->nominal, 0, ',', '.') }}</option>
                @endforeach
            </select>
            @error('kategori_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection