@extends('Administrator.template')
@section('content')
    <div class="container">
        <h1>Anggota Iuran</h1>
    </div>
    <div class="container mt-3">
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-success">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Periode</th>
                </tr>
            </thead>
                @foreach ($anggotaiuran as $item)
            <tbody>
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $item->member->name }}</td>
                    <td>{{ $item->duesCategory->period }}</td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
    @endsection
