@extends('Administrator.template')
@section('content')
    <div class="container" style="width: 1000px; margin-top: 20px;">
        <h1>Data Iuran</h1>
        <div class="container mt-5">
        <a class="btn" style="background-color: #386641; color: #FED16A" href="{{route('warga-create')}}">Tambah Data</a>
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-success">
                <tr>
                    <th>No</th>
                    <th>Periode</th>
                    <th>Nominal</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
    @endsection
