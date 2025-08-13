@extends('Administrator.template')
@section('content')
    <div class="container" style="width: 1000px; margin-top: 20px; margin-left: 50px;">
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
        <h1>Edit Data</h1>
        <div class="container">
            <div class="card-body" style="width: 400px; display: flex; flex-direction: column; align-items: center; margin-top: 20px;">
                <form action="{{ route('warga-update', Crypt::encrypt($warga->id)) }}" method="POST">
                    @csrf
                    <input type="text" name="name" class="form-control mb-3" placeholder="Nama" value="{{ $warga->name }}" required>
                    <input type="text" name="nik" class="form-control mb-3" placeholder="NIK" value="{{ $warga->nik }}" required>
                    <input type="text" name="username" class="form-control mb-3" placeholder="Username" value="{{ $warga->user->username }}" required>
                    <input type="text" name="number_handphone" class="form-control mb-3" placeholder="No. Telepon" value="{{ $warga->number_handphone }}" required>
                    <input type="text" name="addres" class="form-control mb-3" placeholder="Alamat" value="{{ $warga->addres }}" required>
                    <input type="password" name="password" class="form-control mb-3" placeholder="Password">
                    <button type="submit" class="btn" style="width: 300px; background-color: #FED16A; color: #386641" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
