@extends('Administrator.template')
@section('content')
    <div class="container" style="width: 1000px; margin-top: 20px;">
        <h1>Data Warga</h1>
    </div>
    <div class="container mt-5">
        <a class="btn" style="background-color: #386641; color: #FED16A" href="{{route('warga-create')}}">Tambah Data</a>
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
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
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->no_telepon }}</td>
                    <td>{{ $item->level }}</td>
                    <td>
                        <a class="btn btn-warning" href="#">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a class="btn btn-danger" href="#">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                    {{-- <td>
                        <a class="btn btn-warning" href="{{route('#', Crypt::encrypt($item->id))}}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a class="btn btn-danger" href="{{route('#',Crypt::encrypt($item->id))}}" onclick="return confirm('Hapus data ini?')">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td> --}}
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
@endsection
