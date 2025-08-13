@extends('Administrator.template')
@section('content')
    <div class="container" style="width: 1000px; margin-top: 20px;">
        <h1>Tagihan</h1>
        <div class="container mt-5">
            {{-- <form action="{{ route('warga.index') }}" method="GET" class="mb-3 d-flex"> --}}
                <div class="d-flex">
                    <input type="text" style="width: 200px" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Cari nama atau nik...">
                    <button type="submit" class="btn" style="background-color: #FED16A; color: #386641">Cari</button>
                </div>
            </form>
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-success">
                <tr>
                    <th>Id Pengguna</th>
                    <th>Nomor Induk</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
                {{-- @foreach ($dues as $item)
            <tbody>
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $item->period }}</td>
                    <td>{{ $item->nominal }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <img src="{{ asset('storage/image-iuran/'.$item->image)}}" width="100" height="100" alt="">
                    </td>
                    <td>
                        {{-- <a class="btn btn-warning" href="{{route('warga-edit', Crypt::encrypt($item->id))}}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a class="btn btn-danger" href="{{route('warga-delete',Crypt::encrypt($item->id))}}" onclick="return confirm('Hapus data ini?')">
                            <i class="fa-solid fa-trash"></i>
                        </a> --}}
                    {{-- </td>
                </tr>
            </tbody>
            @endforeach --}}
        </table>
    </div>
    @endsection
