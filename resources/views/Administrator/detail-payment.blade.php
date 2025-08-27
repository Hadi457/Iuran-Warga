@extends('Administrator.template')
@section('content')
<div class="container">
    <h1>Data Tagihan</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert mt-4 alert-success alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>{{session('success')}}</strong>
        </div>
    @endif
    <table class="table table-bordered mt-3">
        <thead class="table-success">
            <tr>
                <th>Nama Warga</th>
                <th>Petugas</th>
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
                <td>{{ $p->officer?->user?->name ?? '-' }}</td>
                <td>{{ $p->period }}</td>
                <td>{{ number_format($p->duesCategory->nominal, 0, ',', '.') }}</td>
                <td>{{ date('d-m-Y', strtotime($p->payment_date)) }}</td>
                <td>{{ $p->periode_tagihan }}</td>
                <td>
                    <a class="btn btn-danger" href="{{route('payments.destroy',Crypt::encrypt($p->id))}}" onclick="return confirm('Hapus data ini?')">
                        <i class="fa-solid fa-trash"></i>
                    </a>
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