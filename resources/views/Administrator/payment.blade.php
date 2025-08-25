@extends('Administrator.template')
@section('content')
    <div class="container" style="width: 1000px; margin-top: 20px;">
        <h1>Data Tagihan</h1>
    </div>
    <div class="container mt-5">
        <form action="{{ url('/cari') }}" method="GET" class="d-flex mb-3" style="width: 300px">
            <input type="text" name="q" class="form-control me-2" placeholder="Cari data..." value="{{ request('q') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>

        <table class="table table-bordered table-striped mt-3">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
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

                    <td>
                        <a class="btn btn-warning" href="{{ route('tagihan.pilih', $item->id) }}">Lihat Tagihan</a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
@endsection
