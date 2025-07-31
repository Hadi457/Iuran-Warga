@extends('Administrator.template')
@section('content')
    <div class="container" style="width: 1000px; margin-top: 20px;">
        <h1>Dashboard</h1>
        <div class="d-md-flex gap-3 mt-4">
        <div class="card" style="width: 300px; background-color: #386641;">
            <div class="card-body d-flex align-items-center justify-content-between text-white">
                <i class="fa-solid fa-person" style="font-size: 50px; color: #FED16A"></i>
                <div class="item-count text-end fw-bold" style="color: #FED16A">
                    <h6>Data Warga</h6>
                </div>
            </div>
        </div>
        <div class="card" style="width: 300px; background-color: #386641;">
            <div class="card-body d-flex align-items-center justify-content-between text-white">
                <i class="fa-solid fa-chart-simple" style="font-size: 50px; color: #FED16A"></i>
                <div class="item-count text-end fw-bold" style="color: #FED16A">
                    <h6>Data Iuran</h6>
                </div>
            </div>
        </div>
        <div class="card" style="width: 300px; background-color: #386641;">
            <div class="card-body d-flex align-items-center justify-content-between text-white">
               <i class="fa-solid fa-circle-check" style="font-size: 50px; color: #FED16A"></i>
                <div class="item-count text-end fw-bold" style="color: #FED16A">
                    <h6>Sudah Bayar</h6>
                </div>
            </div>
        </div>
        <div class="card" style="width: 300px; background-color: #386641;">
            <div class="card-body d-flex align-items-center justify-content-between text-white">
                <i class="fa-solid fa-circle-xmark" style="font-size: 50px; color: #FED16A"></i>
                <div class="item-count text-end fw-bold" style="color: #FED16A">
                    <h6>Belum Bayar</h6>
                </div>
            </div>
        </div>
    </div>
@endsection
