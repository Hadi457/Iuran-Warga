@extends('Administrator.template')
@section('content')
    <div class="container" style="width: 1000px; margin-top: 20px;">
        <h1>Data Warga</h1>
    </div>
    <div class="container mt-5">
        <a class="btn" style="background-color: #386641; color: #FED16A" href="/add">Tambah Data</a>
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
