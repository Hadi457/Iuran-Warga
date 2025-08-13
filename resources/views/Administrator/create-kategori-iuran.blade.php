@extends('Administrator.template')
@section('content')
    <div class="container" style="width: 1000px; margin-top: 20px; margin-left: 50px;">
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
        <div class="container">
            <div class="card-body" style="width: 400px; display: flex; flex-direction: column; align-items: center; margin-top: 20px;">
                <form action="{{ route('iuran-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <select name="period" class="form-control mb-3">
                        <option value="bulanan">bulanan</option>
                        <option value="tahunan">tahunan</option>
                        <option value="mingguan">mingguan</option>
                    </select>
                    <input type="text" name="nominal" class="form-control mb-3" placeholder="Nominal" required>
                    <input type="text" name="status" class="form-control mb-3" placeholder="Status">
                    <button type="submit" class="btn" style="width: 300px; background-color: #FED16A; color: #386641" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
