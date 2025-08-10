@extends('template')
@section('content')
<div class="container mt-5 mb-5">
    <div class="text-center p-4 mb-5 rounded shadow" style="background: linear-gradient(90deg,rgba(56, 102, 65, 1) 15%, rgba(70, 189, 72, 1) 100%); color: white;">
        <h1 class="fw-bold">Tata Tertib Warga RW03</h1>
        <p class="mb-0">Mari bersama menjaga keamanan, kebersihan, dan kerukunan lingkungan</p>
    </div>
    <div class="card shadow mb-4 border-primary">
        <div class="card-header bg-primary text-white fw-bold d-flex justify-content-center align-items-center" style="height: 50px; font-size: 20px">Umum</div>
        <div class="card-body">
            <ul class="mb-0">
                <li>Warga wajib menjaga keamanan, ketertiban, dan kebersihan lingkungan.</li>
                <li>Warga dilarang melakukan tindakan yang merugikan orang lain maupun lingkungan.</li>
                <li>Warga diharapkan saling menghormati dan menjaga kerukunan antar tetangga.</li>
                <li>Segala bentuk kegiatan yang melibatkan warga harus melalui izin Ketua RW/RT setempat.</li>
            </ul>
        </div>
    </div>
    <div class="card shadow mb-4 border-success">
        <div class="card-header bg-success text-white fw-bold d-flex justify-content-center align-items-center" style="height: 50px; font-size: 20px"">Keamanan dan Ketertiban</div>
        <div class="card-body">
            <ul class="mb-0">
                <li>Jam bertamu dibatasi pukul <strong>07.00-22.00 WIB</strong> kecuali ada keperluan mendesak.</li>
                <li>Kendaraan bermotor yang masuk lingkungan harus diparkir pada tempat yang telah disediakan.</li>
                <li>Warga wajib melapor kepada pengurus jika ada tamu menginap lebih dari 1x24 jam.</li>
                <li>Dilarang membawa, mengonsumsi, atau memperjualbelikan minuman keras, narkoba, dan barang terlarang lainnya.</li>
            </ul>
        </div>
    </div>
    <div class="card shadow mb-4 border-warning">
        <div class="card-header bg-warning text-white fw-bold d-flex justify-content-center align-items-center" style="height: 50px; font-size: 20px">Kebersihan dan Lingkungan</div>
        <div class="card-body">
            <ul class="mb-0">
                <li>Setiap warga wajib menjaga kebersihan halaman rumah dan lingkungan sekitar.</li>
                <li>Pembuangan sampah dilakukan pada tempat yang telah disediakan, sesuai jadwal pengangkutan.</li>
                <li>Warga diharapkan melakukan kerja bakti rutin minimal 1x sebulan.</li>
                <li>Tidak diperkenankan membakar sampah sembarangan yang dapat mengganggu kenyamanan warga lain.</li>
            </ul>
        </div>
    </div>
    <div class="card shadow mb-4 border-danger">
        <div class="card-header bg-danger text-white fw-bold d-flex justify-content-center align-items-center" style="height: 50px; font-size: 20px">Sanksi</div>
        <div class="card-body">
            <ul class="mb-0">
                <li>Pelanggaran terhadap tata tertib akan dikenakan teguran lisan atau tertulis.</li>
                <li>Pelanggaran berulang dapat dikenakan sanksi sesuai kesepakatan musyawarah warga.</li>
            </ul>
        </div>
    </div>
    <div class="card shadow border-dark">
        <div class="card-header bg-dark text-white fw-bold d-flex justify-content-center align-items-center" style="height: 50px; font-size: 20px">Penutup</div>
        <div class="card-body">
            <p class="mb-0">
                Tata tertib ini dibuat untuk menjaga kenyamanan, keamanan, dan kerukunan warga eRWe.  
                Mari kita laksanakan dengan penuh kesadaran dan tanggung jawab demi lingkungan yang aman, nyaman, dan harmonis.
            </p>
        </div>
    </div>

</div>
@endsection
