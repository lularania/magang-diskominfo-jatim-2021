<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hoster | Login</title>
    <link rel="icon" href="{{ asset('assets/img/jatim.png') }}" type="image/png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/') }}/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="diskominfo h1 text-info">
        <img src="{{ asset('assets/img/jatim.png') }}" style="width: 45px;">
        <b class="ml-2">DISKOMINFO JATIM</b>
    </div>

    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1">Hoster</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group has-feedback">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <label for="remember">

                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- /.social-auth-links -->

                <p class="mb-1">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">I forgot my password</a>
                        {{-- <a href="forgot-password.html">I forgot my password</a>
                {{ __('Forgot Your Password?') }}
            </a> --}}
                    @endif
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    {{-- <!-- jQuery --> --}}
    <script src="{{ asset('assets/adminlte/') }}/plugins/jquery/jquery.min.js"></script>
    {{-- <!-- Bootstrap 4 --> --}}
    <script src="{{ asset('assets/adminlte/') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    {{-- <!-- AdminLTE App --> --}}
    <script src="{{ asset('assets/adminlte/') }}/dist/js/adminlte.min.js"></script>
</body>

</html>
