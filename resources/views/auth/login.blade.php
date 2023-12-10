<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iCLOP | Login</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">

    <style>
        /* Custom Styles */
        body {
            font-family: 'Source Sans Pro', sans-serif;
            background-color: #f4f6f9; /* Ubah warna latar belakang sesuai keinginan */
        }

        .login-box {
            margin: 10% auto;
            width: 360px; /* Sesuaikan lebar kotak login */
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff; /* Ubah warna header sesuai keinginan */
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            padding: 30px;
        }

        .btn-primary {
            background-color: #007bff; /* Ubah warna tombol sesuai keinginan */
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Ubah warna hover sesuai keinginan */
            border-color: #0056b3;
        }
    </style>
</head>

<body class="hold-transition login-page night-mode">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1">
                    <img src="{{ asset('dist/img/logo1.png') }}" width="35%" alt="User Image">
                </a>
            </div>
            <div class="card-body">
                <p class="login-box-msg" style="font-size: 24px;">Sign In</p>
                <form action="{{ route('login') }}" method="post" style="font-size: 16px;">
                    @csrf
                    @if (Session::get('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        {{-- <span class="text-danger error-text email_error"></span> --}}
                        @error('email')
                            <span class="invalid-feedback" role="alert" style="font-size: 16px;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        {{-- <span class="text-danger error-text password_error"></span> --}}
                        @error('password')
                        <span class="invalid-feedback" role="alert" style="font-size: 16px;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="icheck-primary" style="font-size: 16px;">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
                </p>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js?v=3.2.0') }}"></script>
</body>

</html>
