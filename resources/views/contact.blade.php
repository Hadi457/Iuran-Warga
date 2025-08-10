@extends('template')

@section('content')
<div class="container mt-5 mb-5">
    <div class="text-center p-4 mb-5 rounded shadow" style="background: linear-gradient(90deg,rgba(56, 102, 65, 1) 15%, rgba(70, 189, 72, 1) 100%); color: white;">
        <h1 class="fw-bold">Hubungi Kami</h1>
        <p class="mb-0">Kami siap membantu dan mendengar masukan Anda</p>
    </div>
    <div class="row">
        <div class="col-md-5 mb-4">
            <div class="card shadow border-primary h-100">
                <div class="card-header bg-primary text-white fw-bold text-center" style="height: 50px; font-size: 20px">Ketua RW03</div>
                <div class="card-body">
                    <p><strong>Alamat:</strong> Jl. Contoh No.123, Tasikmalaya, Jawa Barat</p>
                    <p><strong>Telepon:</strong> +62 812-3456-7890</p>
                    <p><strong>Email:</strong> info@erwe.com</p>
                    <p><strong>Jam Operasional:</strong><br>Senin - Jumat: 08.00 - 17.00 WIB</p>
                    <hr>
                    <p>Ikuti kami di:</p>
                    <a href="#" class="btn btn-sm btn-primary me-2"><i class="bi bi-facebook"></i> Facebook</a>
                    <a href="#" class="btn btn-sm btn-info text-white me-2"><i class="bi bi-twitter"></i> Twitter</a>
                    <a href="#" class="btn btn-sm btn-danger"><i class="bi bi-instagram"></i> Instagram</a>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card shadow border-success">
                <div class="card-header bg-success text-white fw-bold">Kirim Pesan</div>
                <div class="card-body">
                    {{-- <form method="POST" action="{{ route('contact.send') }}"> --}}
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama Anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="contoh@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subjek</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Masukkan subjek pesan" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Tulis pesan Anda di sini..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="bi bi-send"></i> Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
