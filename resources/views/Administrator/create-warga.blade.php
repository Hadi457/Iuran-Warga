@extends('Administrator.template')
@section('content')
    <div class="container">
        <h1>Tambah Data Baru</h1>
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
                <form action="{{ route('warga-store') }}" method="POST">
                    @csrf
                    <input type="text" name="name" class="form-control mb-3" placeholder="Nama" required>
                    <input type="text" name="nik" class="form-control mb-3" placeholder="NIK" required>
                    <input type="text" name="username" class="form-control mb-3" placeholder="Username" required>
                    <input type="text" name="number_handphone" class="form-control mb-3" placeholder="No. Telepon" required>
                    <input type="text" name="addres" class="form-control mb-3" placeholder="Alamat" required>
                    <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
                    <button type="submit" class="btn" style="width: 100%; background-color: #FED16A; color: #386641" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
