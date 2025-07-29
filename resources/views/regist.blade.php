<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
</head>
<body class="bg-light min-vh-100 d-flex flex-column">
    <div class="container mt-5 text-white p-5 rounded">
        <div class="card d-flex justify-content-center align-items-center mx-auto" style="width: 500px; height: 400px;">
            <div class="mt-5">
                <h2>Welcome To</h2>
                <h2>Our Dues</h2>
            </div>
            <div class="card-body" style="height: 200px; width: 400px; justify-content: center; align-items: center; display: flex; flex-direction: column;">
                <input type="text" name="name" class="form-control mb-3" placeholder="Your Name">
                <input type="text" name="username" class="form-control mb-3" placeholder="Your Name">
                <input type="text" name="password" class="form-control mb-3" placeholder="Password">
                <option type="text" name="level" class="form-control mb-3" placeholder="Level"></option>
                <div class="container d-flex flex-column justify-content-center align-items-center gap-2">
                    <a href="" class="btn btn-secondary" style="width: 350px">Register</a>
                </div>
            </div>
        </div>
    </div>
    <footer class="text-center mt-5">
        <p>&copy; {{ date('Y') }} Iuran Warga. All rights reserved.</p>
    </footer>
</body>
<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</html>
