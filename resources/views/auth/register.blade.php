<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iCLOP | Registration</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css?v=3.2.0')}}">

    <style>
        /* Custom styles can be added here */
        body {
            font-family: 'Source Sans Pro', sans-serif;
            background-color: #f4f6f9; /* Ubah sesuai kebutuhan */
        }

        .register-box {
            margin: 5% auto;
            width: 400px;
            /* Ubah lebar sesuai kebutuhan */
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff; /* Ubah warna header sesuai kebutuhan */
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            padding: 30px;
        }

        .btn-primary {
            background-color: #007bff; /* Ubah warna tombol sesuai kebutuhan */
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Ubah warna hover sesuai kebutuhan */
            border-color: #0056b3;
        }
    </style>
</head>

<body class="hold-transition register-page night-mode">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1">
                    <img src="{{ asset('dist/img/logo1.png') }}" width="35%" alt="User Image">
                    {{-- <b>iCLOP</b></a> --}}
            </div>
            <div class="card-body">
                <p class="login-box-msg" style="font-size: 24px;">Register</p>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    @if ( Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    <div class="input-group mb-3">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                            placeholder="Name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('name')
                        <span class="invalid-feedback" role="alert" style="font-size: 16px;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                        @error('email')
                        <span class="invalid-feedback" role="alert" style="font-size: 16px;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert" style="font-size: 16px;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password" placeholder="Konfirmasi Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <span class="text-danger error-text password_confirmation_error"></span>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </div>
                </form>
                <a href="{{route('login')}}" class="text-center" style="font-size: 16px;">I already have a membership</a>
            </div>
        </div>
    </div>


    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('dist/js/adminlte.min.js?v=3.2.0')}}"></script>
</body>

</html>
