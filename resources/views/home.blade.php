@extends('template')
@section('content')

<!-- Hero Section -->
<div class="text-center p-5 mb-5 rounded shadow" 
     style="background: linear-gradient(90deg, #386641 15%, #FED16A 100%); color:white;">
    <h1 class="fw-bold">Selamat Datang di Website RW03</h1>
    <p class="fs-5">Wadah informasi, pelayanan, dan kebersamaan warga RW03</p>
</div>

<h2 class="text-center fw-bold mb-4" style="color:#386641;">Pilihan</h2>
<div class="row text-center mb-3">
    <div class="col-md-3 mb-3">
        <a href="/data" class="text-decoration-none">
        <div class="card shadow border-0 rounded-4 h-100" style="background:#386641; color:white;">
            <div class="card-body">
                <h5 class="fw-bold">👥 Data Warga</h5>
                <p>Informasi lengkap warga RW03 dalam satu sistem.</p>
            </div>
        </div>
        </a>
    </div>
    <div class="col-md-3 mb-3">
        <a href="" class="text-decoration-none">
            <div class="card shadow border-0 rounded-4 h-100" style="background:#FED16A; color:#333;">
                <div class="card-body">
                    <h5 class="fw-bold">💳 Iuran Rutin</h5>
                    <p>Tagihan Iuran Anda</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3 mb-3">
        <a href="" class="text-decoration-none">
        <div class="card shadow border-0 rounded-4 h-100" style="background:#386641; color:white;">
            <div class="card-body">
                <h5 class="fw-bold">📢 Fasilitas</h5>
                <p>Pengumuman kegiatan dan berita terbaru RW03.</p>
            </div>
        </div>
        </a>
    </div>
    <div class="col-md-3 mb-3">
        <a href="" class="text-decoration-none">
        <div class="card shadow border-0 rounded-4 h-100" style="background:#FED16A; color:#333;">
            <div class="card-body">
                <h5 class="fw-bold">📝 Layanan Aduan</h5>
                <p>Laporkan masalah lingkungan dengan cepat.</p>
            </div>
        </div>
        </a>
    </div>
</div>
<div class="container">
    <!-- Tentang RW03 -->
    <div class="row mb-5 align-items-center">
        <div class="col-md-6 mb-3">
            <img src= "{{ asset('assets/image/suka.png') }}" class="img-fluid rounded shadow" alt="Komunitas RW03">
        </div>
        <div class="col-md-6 mb-3">
            <h2 class="fw-bold text-center mb-3" style="color:#386641;">RW 03</h2>
            <p class="text-center">
                RW03 adalah lingkungan yang menjunjung tinggi nilai kebersamaan, 
                gotong royong, dan transparansi. Website ini hadir sebagai sarana untuk
                 memudahkan warga dalam mengakses informasi, pembayaran iuran, serta layanan 
                 lainnya. Melalui platform ini, diharapkan seluruh warga dapat lebih mudah mendapatkan 
                 informasi terbaru mengenai kegiatan lingkungan, pengumuman penting, hingga 
                 layanan administrasi tanpa harus repot datang langsung ke balai RW. Selain sebagai pusat informasi, website ini juga menjadi wadah untuk memperkuat ikatan sosial antarwarga. Dengan adanya sistem digital ini, segala bentuk komunikasi, penyampaian aspirasi, maupun layanan aduan dapat dilakukan dengan lebih cepat, terbuka, dan teratur.
            </p>
        </div>
    </div>

    <!-- Berita/Kegiatan -->
    <h2 class="text-center fw-bold mb-4" style="color:#386641;">Berita & Kegiatan</h2>
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card shadow border-0 h-100">
                <img src="https://source.unsplash.com/400x250/?meeting" class="card-img-top" alt="Berita">
                <div class="card-body">
                    <h5 class="fw-bold">Kerja Bakti Mingguan</h5>
                    <p>Kegiatan rutin warga RW03 dalam menjaga kebersihan lingkungan.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow border-0 h-100">
                <img src="https://source.unsplash.com/400x250/?celebration" class="card-img-top" alt="Berita">
                <div class="card-body">
                    <h5 class="fw-bold">HUT RI ke-80</h5>
                    <p>Perlombaan seru dan kebersamaan dalam merayakan Hari Kemerdekaan.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow border-0 h-100">
                <img src="https://source.unsplash.com/400x250/?security" class="card-img-top" alt="Berita">
                <div class="card-body">
                    <h5 class="fw-bold">Poskamling Baru</h5>
                    <p>Fasilitas pos keamanan lingkungan telah diresmikan untuk menjaga kenyamanan warga.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
