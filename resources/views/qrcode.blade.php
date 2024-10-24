<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Order And Menu</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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
    <link href="{{ asset('front-assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('front-assets/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('front-assets/css/style.css')}}" rel="stylesheet">
    <style>

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top:80px;
}

.image-container {
    position: relative;
    display: inline-block;
}

.menu-image {
    display: block;
    margin: auto;
    max-width: 100%; /* Adjust as per your image size */
    padding-left:290px;
}

.qr-container {
    position: relative;
    top: 38%; /* Adjust the position on the image */
    left: -50%;
    margin-top:300px;
    transform: translate(-50%, -50%); /* Centers the QR code */
   
    padding: 10px; /* Optional: adds padding around the QR code */
    z-index: 2;
}
.col-lg-3 {
        /* flex: 0 0 auto; */
        width: 33%;
        padding:0px 80px;
    }
    .qr-container svg{
                width: 268px !important;
            }


@media (max-width: 768px) {
    .qr-container {
        top: 40%; /* Adjust QR code position for smaller screens */
        left: -268px; /* Center the QR code more */
        transform: translate(-50%, -50%);
        max-width: 150px; /* Scale down the QR code size */
        background-color:none;
        
    }
    .qr-container svg{
        width: 176px !important;
            }
    .container {
    
    padding-top:0%;
    margin-bottom:-19;
}

    .menu-image {
        max-width: 89%; /* Scale down image on mobile */
    }
    img,svg{
        width: 100%;
    }
    .col-lg-3 {
        /* flex: 0 0 auto; */
        width: 33%;
        padding:0px 80px;
    }

}
   
    /* Responsive adjustments for mobile devices */
@media (max-width: 480px) {
    .qr-container {
        top: 22%; /* Keep centered for mobile */
        left: -68%;
        transform: translate(-50%, -50%);
        max-width: 121px; /* Smaller QR code size on mobile */
        width: 30%; /* Increase width as per screen size */
        padding:0px;
        background:none;
        
    }
    .qr-container svg{
    width: 176px !important;
            }
    .container {
    
    padding-top:0%;
    margin-bottom:-20%;
}
    
    .menu-image {
        width: 91%;
            padding-left: 0px;
            margin-left: 17%;
            margin-right: -16%;}
    img,svg{
        width: 100%;
        background-color:transparent;
    padding-left:15px;
}
.col-lg-3 {
        flex: 0 0 auto;
        width: 152%;
       
    }
    
    
    }
      
    </style> 
</head>
<body>
   
<div class="bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


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
                        <a href="{{ route('home.about-us') }}" class="nav-item nav-link">About US</a>
                        <a href="{{ route('home.contact-us') }}" class="nav-item nav-link">Contact Us</a>
                        <a href="{{ route('home.services') }}" class="nav-item nav-link active">Disclaimer</a>
                        
                    </div>
                    <a href="{{ route('home.login') }}" class="btn btn-primary py-2 px-4">Sign In</a>
                </div>
            </nav>
        <!-- Navbar & Hero End -->



    <div class="container">
        <img src="{{ asset('temp/' . $menuImage->name) }}" class="menu-image" alt="Menu Image">
        
        <div class="qr-container">
            {!! $qrCode !!}
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

        <!-- Footer End -->


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