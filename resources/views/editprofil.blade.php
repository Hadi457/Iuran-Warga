@extends('template')
@section('content')
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
    <div class="container" style="width: 1000px; margin-top: 50px;">
        <form action="{{ route('profile-update', Crypt::encrypt($warga->id)) }}" method="POST">
        @csrf
            <div class="card border-0 shadow-sm mx-auto bg-white" style="width: 500px; height:auto">
                <div class="card-header text-white text-center" style="background-color: #386641;">
                    <h4 class="mb-0" style="color: #FED16A">Profil Warga</h4>
                </div>
                <div class="card-body px-4 py-5" style="display:flex; flex-direction:column; justify-content:center; align-items:center">
                    <div class="mt-5" style="width: 400px; justify-content: center; align-items: center; display: flex; flex-direction: column;">
                        <input type="text" name="name" class="form-control mb-3" placeholder="Nama" value="{{ $warga->name ?? '' }}">
                        <input type="text" name="username" class="form-control mb-3" placeholder="Username" value="{{ $warga->username}}">
                        <input type="text" name="alamat" class="form-control mb-3" placeholder="Alamat" value="{{ $warga->alamat}}">
                        <input type="text" name="no_telepon" class="form-control mb-3" placeholder="Nomor Telepon" value="{{ $warga->no_telepon ?? '' }}">
                        <input type="text" name="password" class="form-control mb-3" placeholder="Password" value="{{ $warga->no_telepon ?? '' }}">
                        <div class="container gap-2" style="display: flex;">
                            <button type="submit" class="btn fw-bold" style="width: 300px; background-color: #386641; color: #FED16A">Simpan</button>
                            <a class="btn fw-bold" style="width: 300px; background-color: red; color: white" href="/profil">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection