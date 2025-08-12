@extends('template')
@section('content')
<div class="container min-vh-100">
    <div class="w-100 position-relative mt-5" style="height: 500px;">
        <div class="text-overlay position-absolute bottom-0 start-0 text-white p-3 m-3" style="z-index: 10;">
            <div class="fs-2 fw-bold">Wilujeung Sumping di Website <a style="color: #FED16A">KitaRW03</a></div>
            <p class="fw-bold">UNTUK WARGA DAN MASA DEPAN</p>
        </div>
        <div id="carouselExample" class="carousel slide h-100" data-bs-ride="carousel">
            <div class="carousel-inner h-100">

                <div class="carousel-item active h-100 position-relative">
                    <img src="{{ asset('assets/image/stonk.jpg') }}" class="d-block w-100 h-100" alt="Slide 1" style="object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.4);"></div>
                </div>

                <div class="carousel-item h-100 position-relative">
                    <img src="{{ asset('assets/image/suka.png') }}" class="d-block w-100 h-100" alt="Slide 2" style="object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.4);"></div>
                </div>

                <div class="carousel-item h-100 position-relative">
                    <img src="{{ asset('assets/image/herang.png') }}" class="d-block w-100 h-100" alt="Slide 3" style="object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.4);"></div>
                </div>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Sebelumnya</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Berikutnya</span>
            </button>
        </div>
    </div>
    <div class="w-100 position-relative mt-5" style="height: 500px;">
        <h2 class="mt-5">Tagihan Aktif</h2>
        <div style="background-color: #386641; width:200px; height: 5px;"></div>
        <div class="row g-3 mt-3">
            @foreach ($tagihan as $item)
            <div class="col-3 mb-3">
                <div class="card h-100 d-flex flex-column">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->period }}</h5>
                        <img class="card-img-top" style="object-fit: contain; width: 100%; height: 300px" src="{{ asset('storage/image-iuran/'.$item->image)}}" alt="Title" />
                        <p class="card-text">Nominal: Rp. {{ number_format($item->nominal, 0, ',', '.') }}</p>
                        <a href="#" class="btn btn-primary">Bayar Tagihan</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
