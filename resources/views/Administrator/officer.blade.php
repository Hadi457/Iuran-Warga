@extends('Administrator.template')
@section('content')
    <div class="container">
        <h1>Officer</h1>
    </div>
    <div class="container mt-3">
        <a class="btn" style="background-color: #386641; color: #FED16A" href="{{route('officer-create')}}">Tambah Officer</a>
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>Nama Officer</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            @foreach ($officer as $item)
            <tbody>
                <tr>
                    <td scope="row">{{ $item->id }}</td>
                    <td>{{$item->user->name}}</td>
                    <td>
                        <a class="btn btn-warning" href="{{route('officer-edit', Crypt::encrypt($item->id))}}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a class="btn btn-danger" href="{{route('officer-delete',Crypt::encrypt($item->id))}}" onclick="return confirm('Hapus data ini?')">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
@endsection
