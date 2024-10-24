<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Order And Menu</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Favicon -->
    <link href="{{ asset('front-assets/img/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('front-assets/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{ asset('front-assets/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset('front-assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('front-assets/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('front-assets/css/style.css')}}" rel="stylesheet">
     <style type="text/css">
          .col-lg-3 {
        /* flex: 0 0 auto; */
        width: 33%;
        padding:0px 80px;
    }
    </style>

</head>

<body>

    <!-- Navbar & Hero Start -->
    <div class="position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
            <a href="{{ route('home.index') }}" class="navbar-brand p-0">
               <img src="{{ asset('front-assets/img/food-logo.png')}}" alt="Logo" class="food-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0 pe-4">
                    <a href="{{ route('home.index') }}" class="nav-item nav-link">Home</a>
                    <a href="{{ route('home.about-us') }}" class="nav-item nav-link active">About Us</a>
                    <a href="{{ route('home.contact-us') }}" class="nav-item nav-link">Contact Us</a>
                    <a href="{{ route('home.services') }}" class="nav-item nav-link">Disclaimer</a>
                </div>
                <a href="{{ route('home.login') }}" class="btn btn-primary py-2 px-4">Sign In</a>
            </div>
        </nav>

        <!-- Spacing for the header -->
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Reset Password') }}</div>
                        <div class="card-body">
                            <p>{{ __('Please enter your email address to receive a password reset link.') }}</p>
                            <form action="{{ route('password.email') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Send Password Reset Link') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="text-center small mt-3">
                                {{ __('Go Back to Login?') }} <a href="{{ route('home.login') }}">{{ __('Login Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


       <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Company</h4>
                        <a class="btn btn-link" href="{{ route('home.index') }}">Home</a>
                        <a class="btn btn-link" href="{{ route('home.about-us') }}">About Us</a>
                        <a class="btn btn-link" href="{{ route('home.contact-us') }}">Contact Us</a>
                        <a class="btn btn-link" href="{{ route('home.services') }}">Disclaimer</a>
                        
                        <!-- <a class="btn btn-link" href="">Terms & Condition</a> -->
                    </div>
                    <div class="col-lg-3 col-md-6">
                    <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Contact</h4>
                    <p class="mb-2" style="color: white;">
                        <i class="fa fa-map-marker-alt me-3"></i>
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode(config('services.address')) }}" target="_blank" style="color: white;">
                            {{ config('services.address') }}
                        </a>
                    </p>
                    <p class="mb-2" style="color: white;">
                        <i class="fa fa-phone-alt me-3"></i>
                        <a href="tel:{{ preg_replace('/\s+/', '', config('services.mobile_number')) }}" style="color: white;">
                            {{ config('services.mobile_number') }}
                        </a>
                    </p>
                    <p class="mb-2" style="color: white;">
                        <i class="fa fa-envelope me-3"></i>
                        <a href="mailto:{{ config('services.email') }}" style="color: white;">
                            {{ config('services.email') }}
                        </a>
                    </p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Newsletter</h4>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>

                    </div>
                </div>
            </div>

        </div>
        <!-- Footer End -->


  <script src="{{ asset('front-assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('front-assets/lib/wow/wow.min.js')}}"></script>
    <script src="{{ asset('front-assets/lib/easing/easing.min.js')}}"></script>
    <script src="{{ asset('front-assets/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{ asset('front-assets/lib/counterup/counterup.min.js')}}"></script>
    <script src="{{ asset('front-assets/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('front-assets/lib/tempusdominus/js/moment.min.js')}}"></script>
    <script src="{{ asset('front-assets/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
    <script src="{{ asset('front-assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('front-assets/js/main.js')}}"></script>
      
</body>

</html>
   

