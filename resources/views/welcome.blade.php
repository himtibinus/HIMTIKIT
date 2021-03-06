<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HIMTI KIT</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <!-- Custom styles for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('fonts/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
</head>

<body class="bg">
    @if (session()->has('LoginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('LoginError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- Animation Sequence Asset --}}
    <img src="./img/astronaut.png" class="astronaut">
    <img src="./img/comet.png" class="comet">

    <div class="container d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <h1 class="text-white text-title">HIMTI KIT</h1>
        <p class="text-white text-description text-justify mw-5">HIMTI KIT is a learning kit for new students in
            School of Computer Science Bina Nusantara University.
            Provided materials start from semester 1 to 4 and can be accessed online through this website.</p>

        <form action="/login" method="POST" class="form-login">
            @csrf
            <div class="input-group input-group-login mb-3">
                <input type="text" class="form-control" placeholder="Insert your Student ID (NIM)"
                    aria-label="Insert your Student ID (NIM)" aria-describedby="basic-addon2" id="NIM"
                    name="NIM" required value="{{ old('NIM') }}">
                <div class="input-group-append">
                    <button class="btn btn-login btn-secondary" type="submit">
                        <i class="fas fa-arrow-right text-black"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
