@extends('template')
@section('content')
<div class="container w-100 position-relative mt-5" style="height: 500px;">
    <div class="text-overlay position-absolute bottom-0 start-0 text-white bg-dark bg-opacity-50 p-3 rounded m-3" style="z-index: 10;">
        <h2>Wilujeung Sumping di Website eRWe</h2>
        <p>UNTUK WARGA DAN MASA DEPAN</p>
    </div>

    <div id="carouselExample" class="carousel slide h-100" data-bs-ride="carousel">
        <div class="carousel-inner h-100">
            <div class="carousel-item active h-100">
                <img src="{{ asset('assets/image/stonk.jpg') }}" class="d-block w-100 h-100" alt="Slide 1" style="object-fit: cover;">
            </div>
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
@endsection
