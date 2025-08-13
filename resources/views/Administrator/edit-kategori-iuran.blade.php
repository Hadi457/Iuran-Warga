@extends('Administrator.template')
@section('content')
    <div class="container" style="width: 1000px; margin-top: 20px; margin-left: 50px;">
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
        <h1>Edit Kategori Iuran</h1>
        <div class="container">
            <div class="card-body" style="width: 400px; display: flex; flex-direction: column; align-items: center; margin-top: 20px;">
                <form action="{{ route('iuran-update', Crypt::encrypt($dues->id)) }}" method="POST">
                    @csrf
                    <select name="period" class="form-control mb-3">
                        <option value="bulanan" {{ $dues->period == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                        <option value="tahunan" {{ $dues->period == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                        <option value="mingguan" {{ $dues->period == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                    </select>
                    <input type="text" name="nominal" class="form-control mb-3" placeholder="Nominal" value="{{ $dues->nominal }}" required>
                    <button type="submit" class="btn" style="width: 300px; background-color: #FED16A; color: #386641" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
