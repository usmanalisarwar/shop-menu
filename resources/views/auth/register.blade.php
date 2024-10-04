<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Shop Menu</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('admin-assets/css/adminlte.min.css')}}">
        <link rel="stylesheet" href="{{ asset('admin-assets/css/custom.css')}}">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
             @include('admin.message')
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="#" class="h3">Administrative Panel</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Sign Up in to start your session</p>
                    <form action="{{route('register')}}" method="post">
                        @csrf
                         <div class="input-group mb-3">
                            <input type="name" name="name" id="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                          <div class="input-group mb-3">
                            <input type="company_name" name="company_name" id="company_name" value="{{old('company_name')}}" class="form-control @error('company_name') is-invalid @enderror" placeholder="Company Name">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('company_name')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password" value="{{old('password')}}" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                         <div class="input-group mb-3">
                            <input type="password_confirmation" name="password_confirmation" id="password_confirmation" value="{{old('password_confirmation')}}" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password_confirmation')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row">
                            <!-- <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div> -->
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <p class="mb-1 mt-3">
                         @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                         @endif
                    </p> 
                    <div class="text-center small">Already have an account? <a href="{{route('login')}}">Login Now</a></div>              
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- ./wrapper -->
        <!-- jQuery -->
        <script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('admin-assets/js/adminlte.min.js')}}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('admin-assets/js/demo.js')}}"></script>
    </body>
</html>