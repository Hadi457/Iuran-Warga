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
    <div class="container my-auto text-white p-5 rounded">
        <div class="card d-flex justify-content-center align-items-center mx-auto rounded-5 p-5" style="width: 500px; background-color: #386641">
            <div class="d-flex text-center" style="color: #FED16A; width: 200px;">
                <h2>Welcome To Our Dues</h2>
            </div>
            <div class="mt-5" style="height: 200px; width: 400px; justify-content: center; align-items: center; display: flex; flex-direction: column;">
                <form action="/login/register" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="name" class="form-control mb-3" placeholder="Your Name">
                    <input type="text" name="username" class="form-control mb-3" placeholder="Useranme">
                    <input type="password" type="text" name="password" class="form-control mb-3" placeholder="Password">
                    <button class="btn" style="width: 300px; background-color: #FED16A; color: #386641">Register</button>
                </form>
                <div class="d-flex mt-3 gap-2 ">
                    <a style="display: flex; font-size: 15px; color: #FED16A">Already Have Account? </a>
                    <a href="/login" class="nav-link" style="font-size: 15px; color: #FED16A">Sign In Here</a>
                </div>
            </div>
        </div>
    </div>
    <footer class="d-flex justify-content-center align-items-center p-3" style="color: #FED16A; background-color: #386641;">
        <p>&copy; {{ date('Y') }} Iuran Warga. All rights reserved.</p>
    </footer>
</body>
<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</html>
