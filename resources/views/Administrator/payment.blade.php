@extends('Administrator.template')
@section('content')
    <div class="container">
        <h1>Data Warga</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert mt-4 alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>{{session('success')}}</strong>
            </div>
        @endif
    </div>
    <div class="container mt-3">
        <a class="btn" style="background-color: #386641; color: #FED16A" href="{{route('payments.create')}}">Tambah Payment</a>
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            @foreach ($warga as $item)
            <tbody>
                <tr>
                    <td scope="row">{{ $item->id }}</td>
                    <td>{{$item->nik}}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->user->username }}</td>
                    <td>{{ $item->addres }}</td>
                    <td>{{ $item->number_handphone }}</td>
                    <td>{{ $item->user->level}}</td>
                    
                    <td>
                        <a class="btn btn-warning" href="{{route('payments.detail', $item->id)}}">
                            <i class="fa-solid fa-circle-info"></i>
                        </a>
                        {{-- <a href="{{ route('payments.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a> --}}
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
@endsection
