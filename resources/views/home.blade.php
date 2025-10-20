@extends('template')
@section('content')

<style>
.hero-section {
    background: linear-gradient(90deg, #386641 15%, #FED16A 100%);
    color: white;
    border-radius: 1rem;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}
.card-feature {
    transition: all 0.3s ease;
    border-radius: 1.2rem;
}
.card-feature:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}
.icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    font-size: 26px;
}
.bg-green {
    background-color: #386641;
    color: white;
}
.bg-yellow {
    background-color: #FED16A;
    color: #333;
}
</style>
<body>
    
    <div class="img-fluid text-center py-5 d-flex align-items-center" style="background: url('{{ asset('assets/image/kokol1.png') }}'); background-repeat: no-repeat; background-size: cover; background-position: center; background-size: cover; position: relative; height: 800px;">
      <div style="background: rgba(0, 0, 50, 0.6); position: absolute; top:0; left:0; width:100%; height:100%;"></div>
      <div class="container position-relative" style="z-index: 2;">
        <img src="{{ asset('assets/image/cocol.png') }}" alt="Logo" width="150" class="mb-4 animate__animated animate__fadeInDown">
        <h1 class="fw-bold text-warning animate__animated animate__fadeInUp">SMA NEGERI 1 SINGAPARNA</h1>
        <p class="lead text-white fst-italic animate__animated animate__fadeInUp animate__delay-2s">
          "Berprestasi, Berkarakter, dan Berbudaya"
        </p>
        <a href="#profil" class="btn btn-warning fw-bold mt-3 shadow-lg animate__animated animate__fadeInUp animate__delay-2s">
          Lihat Profil
        </a>
      </div>
    </div>
    <div class="container">

        <!-- Pilihan Menu -->
        <h2 class="text-center fw-bold mb-4" style="color:#386641;">Pilihan</h2>
        <div class="row text-center mb-5">
            <div class="col-md-3 mb-3">
                <a href="/data" class="text-decoration-none">
                    <div class="card card-feature shadow border-0 h-100 bg-green">
                        <div class="card-body">
                            <div class="icon-circle bg-white bg-opacity-25">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <h5 class="fw-bold">Data Warga</h5>
                            <p>Informasi lengkap warga RW03 dalam satu sistem.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="#" class="text-decoration-none">
                    <div class="card card-feature shadow border-0 h-100 bg-yellow">
                        <div class="card-body">
                            <div class="icon-circle bg-dark bg-opacity-10">
                                <i class="fa-solid fa-wallet"></i>
                            </div>
                            <h5 class="fw-bold">Iuran Rutin</h5>
                            <p>Tagihan dan pembayaran iuran Anda.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="#" class="text-decoration-none">
                    <div class="card card-feature shadow border-0 h-100 bg-green">
                        <div class="card-body">
                            <div class="icon-circle bg-white bg-opacity-25">
                                <i class="fa-solid fa-bullhorn"></i>
                            </div>
                            <h5 class="fw-bold">Fasilitas</h5>
                            <p>Pengumuman kegiatan dan berita terbaru RW03.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="#" class="text-decoration-none">
                    <div class="card card-feature shadow border-0 h-100 bg-yellow">
                        <div class="card-body">
                            <div class="icon-circle bg-dark bg-opacity-10">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                            <h5 class="fw-bold">Layanan Aduan</h5>
                            <p>Laporkan masalah lingkungan dengan cepat.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
        <!-- Tentang RW03 -->
        <div class="container mb-5">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3">
                    <img src="{{ asset('assets/image/suka.png') }}" class="img-fluid rounded shadow" alt="Komunitas RW03">
                </div>
                <div class="col-md-6 mb-3">
                    <h2 class="fw-bold text-center mb-3" style="color:#386641;">Pamoyanan</h2>
                    <p class="text-center">
                        RW03 adalah lingkungan yang menjunjung tinggi nilai kebersamaan, 
                        gotong royong, dan transparansi. Website ini hadir sebagai sarana untuk
                        memudahkan warga dalam mengakses informasi, pembayaran iuran, serta layanan 
                        lainnya. Melalui platform ini, diharapkan seluruh warga dapat lebih mudah mendapatkan 
                        informasi terbaru mengenai kegiatan lingkungan, pengumuman penting, hingga 
                        layanan administrasi tanpa harus repot datang langsung ke balai RW.
                    </p>
                    <p class="text-center">
                        Selain sebagai pusat informasi, website ini juga menjadi wadah untuk memperkuat ikatan sosial antarwarga.
                        Dengan adanya sistem digital ini, komunikasi, penyampaian aspirasi, maupun layanan aduan
                        dapat dilakukan dengan lebih cepat, terbuka, dan teratur.
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Berita / Kegiatan -->
        <div class="container">
            <h2 class="text-center fw-bold mb-4" style="color:#386641;">Berita & Kegiatan</h2>
            <div class="row mb-5">
                <div class="col-md-4 mb-3">
                    <div class="card shadow border-0 h-100">
                        <img src="https://source.unsplash.com/400x250/?meeting" class="card-img-top" alt="Kerja Bakti">
                        <div class="card-body">
                            <h5 class="fw-bold">Kerja Bakti Mingguan</h5>
                            <p>Kegiatan rutin warga RW03 dalam menjaga kebersihan lingkungan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card shadow border-0 h-100">
                        <img src="https://source.unsplash.com/400x250/?celebration" class="card-img-top" alt="HUT RI">
                        <div class="card-body">
                            <h5 class="fw-bold">HUT RI ke-80</h5>
                            <p>Perlombaan seru dan kebersamaan dalam merayakan Hari Kemerdekaan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card shadow border-0 h-100">
                        <img src="https://source.unsplash.com/400x250/?security" class="card-img-top" alt="Poskamling">
                        <div class="card-body">
                            <h5 class="fw-bold">Poskamling Baru</h5>
                            <p>Fasilitas pos keamanan lingkungan telah diresmikan untuk menjaga kenyamanan warga.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</body>
@endsection
