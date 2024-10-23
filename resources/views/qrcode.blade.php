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
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .container {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px; /* Space between the QR code and the menu image */
        }

        .menu-image {
            height: 700px;
            width: 500px;
        }

        .qr-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 200px;
            height: 200px;
            margin-left: 20px;
        }

        .qr-container img {
            width: 100%;
            height: auto;
        }

        /* Navbar Fix */
        nav.navbar {
            z-index: 999;
            position: fixed;
            top: 0;
            width: 100%;
        }

        /* Adjust the main container position to accommodate the fixed navbar */
        .main-content {
            margin-top: 80px; /* Adjust based on the height of the navbar */
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

        <!-- Navbar Start -->
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
        <!-- Navbar End -->

        <!-- Main Content Start -->
        <div class="main-content container">
            <!-- QR Code Container -->
            <div class="qr-container">
                {!! $qrCode !!}
            </div>

            <!-- Menu Image -->
            <img src="{{ asset('temp/' . $menuImage->name) }}" class="menu-image" alt="Menu Image">
        </div>
        <!-- Main Content End -->

    </div>

</body>

</html>
