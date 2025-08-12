@extends('Administrator.template')
@section('content')
    <div class="container" style="width: 1000px; margin-top: 20px;">
        <h1>Data Iuran</h1>
        <div class="container mt-5">
        <a class="btn" style="background-color: #386641; color: #FED16A" href="{{route('iuran-create')}}">Tambah Data</a>
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-success">
                <tr>
                    <th>No</th>
                    <th>Periode</th>
                    <th>Nominal</th>
                    <th>Dibuat Pada</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
                @foreach ($dues as $item)
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
                        a
                        {{-- <a class="btn btn-warning" href="{{route('warga-edit', Crypt::encrypt($item->id))}}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a class="btn btn-danger" href="{{route('warga-delete',Crypt::encrypt($item->id))}}" onclick="return confirm('Hapus data ini?')">
                            <i class="fa-solid fa-trash"></i>
                        </a> --}}
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
    @endsection
