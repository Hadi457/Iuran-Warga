@extends('Administrator.template')
@section('content')
    <div class="container" style="width: 1000px; margin-top: 20px; margin-left: 50px;">
        <h1>Tambah Data Baru</h1>
        <div class="container">
            <div class="card-body" style="width: 400px; display: flex; flex-direction: column; align-items: center; margin-top: 20px;">
                {{-- <form action="{{ route('member-register') }}" method="POST"> --}}
                    @csrf
                    <input type="text" name="name" class="form-control mb-3" placeholder="Full Name" required>
                    <input type="text" name="username" class="form-control mb-3" placeholder="Username" required>
                    <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
                    <button class="btn" style="width: 300px; background-color: #FED16A; color: #386641" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
