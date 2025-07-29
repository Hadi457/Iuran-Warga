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
    <div class="container my-auto mt-5 text-white p-5 rounded">
        <div class="card d-flex justify-content-center align-items-center mx-auto" style="width: 500px; height: 400px; background-color: #386641">
            <div class="mt-5" style="color: #FED16A">
                <h2>Welcome To</h2>
                <h2>Our Dues</h2>
            </div>
            <div class="card-body" style="height: 200px; width: 400px; justify-content: center; align-items: center; display: flex; flex-direction: column;">
                <form action="{{ route('auth.login') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="username" class="form-control mb-3" placeholder="Username">
                    <input type="text" name="password" class="form-control mb-3" placeholder="Password">
                    <button class="btn" style="width: 300px; background-color: #FED16A; color: #386641" type="submit">Login</button>
                </form>
                <div class="d-flex mt-2 gap-2">
                    <a style="display: flex; font-size: 15px; color: #FED16A">Dont Have Any Account? </a>
                    <a href="/login/register" style="font-size: 15px; color: #FED16A">Sign Up Here</a>
                </div>
            </div>
        </div>
    </div>
    <footer class="text-center mt-5" style="color: #FED16A; background-color: #386641;">
        <p>&copy; {{ date('Y') }} OurDues. All rights reserved.</p>
    </footer>
</body>
<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</html>
