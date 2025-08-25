@extends('Administrator.template')
@section('content')
<div class="container">
    <h4>Tagihan {{ $user->name }}</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Nominal</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tagihan as $t)
                <tr>
                    <td>{{ ucfirst($t->category->period) }}</td>
                    <td>Rp{{ number_format($t->category->nominal, 0, ',', '.') }}</td>
                    <td>{{ $t->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada tagihan untuk kategori ini</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('tagihan.lihat', $user->id) }}" class="btn btn-primary">Pilih Kategori Lain</a>
</div>
@endsection
