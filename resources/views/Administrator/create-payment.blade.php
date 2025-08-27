@extends('Administrator.template')

@section('content')
<div class="container mt-4">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <h3>Tambah Payment</h3>
    <form action="{{ route('payments.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Warga</label>
        <select name="member_id" class="form-control">
            @foreach($members as $m)
                <option value="{{ $m->id }}">{{ $m->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Kategori Iuran</label>
        <select name="dues_category_id" class="form-control">
            @foreach($categories as $c)
                <option value="{{ $c->id }}">{{ $c->name }} - Rp {{ number_format($c->nominal) }} / {{ $c->period }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Nominal Total</label>
        <input type="number" name="nominal" class="form-control" >
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
</form>
</div>
@endsection
