@extends('Administrator.template')
@section('content')
    <div class="container">
        <h1>Tambah Officer</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Validate Invalid</strong>
                <ul>
                    @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container mt-3">
            <div class="card-body">
                <form action="{{ route('officer-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <select name="iduser" class="form-control mb-3">
                        <option value="">Pilih Warga</option>
                        @foreach ($members as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn" style="width: 100%; background-color: #FED16A; color: #386641">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection