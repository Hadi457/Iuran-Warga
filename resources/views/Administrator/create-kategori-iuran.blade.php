@extends('Administrator.template')
@section('content')
    <div class="container">
        <h1>Tambah Iuran</h1>
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
                <form action="{{ route('iuran-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <select name="period" class="form-control mb-3">
                        <option value="bulanan">bulanan</option>
                        <option value="tahunan">tahunan</option>
                        <option value="mingguan">mingguan</option>
                    </select>
                    <input type="text" name="nominal" class="form-control mb-3" placeholder="Nominal" required>
                    <input type="text" name="status" class="form-control mb-3" placeholder="Status">
                    <button type="submit" class="btn" style="width: 100%; background-color: #FED16A; color: #386641" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
