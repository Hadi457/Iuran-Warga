@extends('Administrator.template')
@section('content')
<div class="container mt-4">
    <h3>Data Tagihan</h3>
    <table class="table table-bordered">
        <thead class="table-success">
            <tr>
                <th>Nama Warga</th>
                <th>Periode</th>
                <th>Nominal</th>
                <th>Tanggal Bayar</th>
                <th>Periode Tagihan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $p)
            <tr>
                <td>{{ $p->member->name }}</td>
                <td>{{ $p->period }}</td>
                <td>{{ number_format($p->duesCategory->nominal, 0, ',', '.') }}</td>
                <td>{{ $p->due_date->format('d-m-Y') }}</td>
                <td>{{ $p->periode_tagihan }}</td>
                <td>
                    {{-- <a href="{{ route('payments.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                    <form action="{{ route('payments.destroy', $p->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection






{{-- @extends('Administrator.template')
@section('content')
<h4>Data Pembayaran: {{ $member->name }}</h4>

@if($weeklyPayments->count())
    <h5>Mingguan</h5>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nominal</th>
                <th>Minggu ke</th>
                <th>Jatuh Tempo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($weeklyPayments as $index => $payment)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>Rp {{ number_format($payment->nominal) }}</td>
                <td>Minggu ke-{{ $index + 1 }}</td>
                <td>{{ $payment->due_date->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif

@if($monthlyPayments->count())
    <h5>Bulanan</h5>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nominal</th>
                <th>Bulan ke</th>
                <th>Jatuh Tempo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($monthlyPayments as $index => $payment)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>Rp {{ number_format($payment->nominal) }}</td>
                <td>Bulan ke-{{ $index + 1 }}</td>
                <td>{{ $payment->due_date->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif

@if($yearlyPayments->count())
    <h5>Tahunan</h5>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nominal</th>
                <th>Tahun ke</th>
                <th>Jatuh Tempo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($yearlyPayments as $index => $payment)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>Rp {{ number_format($payment->nominal) }}</td>
                <td>Tahun ke-{{ $index + 1 }}</td>
                <td>{{ $payment->due_date->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection --}}