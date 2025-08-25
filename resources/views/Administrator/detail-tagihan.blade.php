@extends('Administrator.template')

@section('content')
<div class="container">
    <h4>Tagihan {{ $user->name }}</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Nominal</th>
                <th>Dibuat Pada</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tagihan as $t)
                <tr>
                    <td>{{ ucfirst($t->duesCategory->period) }}</td>
                    <td>Rp{{ number_format($t->duesCategory->nominal, 0, ',', '.') }}</td>
                    <td>{{ $t->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
