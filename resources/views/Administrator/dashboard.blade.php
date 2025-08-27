@extends('Administrator.template')
@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        <div class="d-md-flex gap-3 mt-4">
        <div class="card" style="width: 400px; background-color: #386641;">
            <div class="card-body d-flex align-items-center justify-content-between text-white">
                <i class="fa-solid fa-person" style="font-size: 50px; color: #FED16A"></i>
                <div class="item-count text-end fw-bold" style="color: #FED16A">
                    <h1>{{ $users->count()}}</h1>
                    <h6>Data Warga</h6>
                </div>
            </div>
        </div>
        <div class="card" style="width: 400px; background-color: #386641;">
            <div class="card-body d-flex align-items-center justify-content-between text-white">
                <i class="fa-solid fa-money-bill" style="font-size: 50px; color: #FED16A"></i>
                <div class="item-count text-end fw-bold" style="color: #FED16A">
                    <h1>{{number_format($payment->sum('nominal'),0,",",".")}}</h1>
                    <h6>Total Kas</h6>
                </div>
            </div>
        </div>
        
    </div>
@endsection
