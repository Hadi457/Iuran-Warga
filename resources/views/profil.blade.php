@extends('template')
@section('content')
    <div class="container" style="width: 1000px; margin-top: 50px;">
        <div class="card border-0 shadow-sm mx-auto bg-white" style="width: 500px;">
            <div class="card-header text-white text-center" style="background-color: #386641;">
                <h4 class="mb-0" style="color: #FED16A">Profil Warga</h4>
            </div>
                <div class="card-body px-4 py-5" style="display:flex; flex-direction:column; justify-content:center; align-items:center">
                    <div class="mt-5" style="width: 400px; justify-content: center; align-items: center; display: flex; flex-direction: column;">
                            <input type="text" name="name" class="form-control mb-3" placeholder="Nama" value="{{ $user->name ?? '' }}" readonly>
                            <input type="text" name="username" class="form-control mb-3" placeholder="Username" value="{{ $user->username ?? '' }}" readonly>
                            <input type="text" name="alamat" class="form-control mb-3" placeholder="Alamat" value="{{ $user->alamat ?? '' }}" readonly>
                            <input type="text" name="no_telepon" class="form-control mb-3" placeholder="Nomor Telepon" value="{{ $user->no_telepon ?? '' }}" readonly>
                            <a class="btn fw-bold" style="width: 300px; background-color: #386641; color: #FED16A" href="/edit">Edit Profil</a>
                    </div>
                </div>
        </div>
    </div>
@endsection