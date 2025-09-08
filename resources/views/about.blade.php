@extends('template')

@section('content')
<div class="container mt-5">

    <!-- Header Section -->
    <div class="text-center mb-5">
        <h1 class="fw-bold" style="color:#386641;">Tentang Kami</h1>
        <p class="fs-5" style="color:#555;">
            Selamat datang di website <b>kitaRW03</b> – wadah informasi, layanan, dan kebersamaan warga RW03.
        </p>
    </div>

    <!-- Content Section -->
    <div class="row align-items-center">
        <div class="col-md-6">
            <img src= "{{ asset('assets/image/warga.jpg') }}"
                 class="img-fluid rounded shadow" 
                 alt="Komunitas RW03">
        </div>
        <div class="col-md-6">
            <div class="p-4 rounded shadow" style="background-color:#FED16A;">
                <h3 class="fw-bold" style="color:#386641;">Visi & Misi</h3>
                <p class="mt-3" style="color:#333;">
                    <b>Visi:</b> Mewujudkan lingkungan RW03 yang harmonis, aman, dan sejahtera.  
                </p>
                <p style="color:#333;">
                    <b>Misi:</b>
                    <ul>
                        <li>Menjalin kebersamaan antarwarga.</li>
                        <li>Meningkatkan transparansi informasi dan iuran.</li>
                        <li>Mendukung kegiatan sosial dan kemasyarakatan.</li>
                        <li>Menjadi platform digital pelayanan warga.</li>
                    </ul>
                </p>
            </div>
        </div>
    </div>

    <!-- Extra Info -->
    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card shadow rounded-4 border-0 h-100" style="background:#386641; color:#fff;">
                <div class="card-body text-center">
                    <h5 class="fw-bold">Transparansi</h5>
                    <p>Informasi terbuka bagi seluruh warga mengenai iuran, kegiatan, dan laporan.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow rounded-4 border-0 h-100" style="background:#FED16A; color:#333;">
                <div class="card-body text-center">
                    <h5 class="fw-bold">Kebersamaan</h5>
                    <p>Mempererat tali silaturahmi antarwarga dengan kegiatan rutin dan online.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow rounded-4 border-0 h-100" style="background:#386641; color:#fff;">
                <div class="card-body text-center">
                    <h5 class="fw-bold">Pelayanan Digital</h5>
                    <p>Memudahkan pengelolaan administrasi, pembayaran, dan pengaduan warga.</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
