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
        /* Set the height of the map */
        #map {
            height: 350px; /* Adjust as needed */
            width: 100%;
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
                        <a href="{{ route('home.about-us') }}" class="nav-item nav-link">About Us</a>
                        <a href="{{ route('home.contact-us') }}" class="nav-item nav-link active">Contact Us</a>
                        <a href="{{ route('home.services') }}" class="nav-item nav-link">Disclaimer</a>
                        </div>
                        
                    </div>
                    <a href="{{ route('home.login') }}" class="btn btn-primary py-2 px-4">Sign In</a>
                </div>
            </nav>
        </div>
        <!-- Navbar & Hero End -->


        <!-- Contact Start -->
        <div class="py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Contact Us</h5>
                    <h1 class="mb-5">Contact For Any Query</h1>
                </div>
                <div class="row g-4">
                    <div class="col-12">
                        <div class="row gy-4">
                            <div class="col-md-4">
                                <h5 class="section-title ff-secondary fw-normal text-start text-primary">Booking</h5>
                                <p><i class="fa fa-envelope-open text-primary me-2"></i><a href="mailto:{{ config('services.email') }}">
                                {{ config('services.email') }}
                                </a></p>
                            </div>
                            <div class="col-md-4">
                                <h5 class="section-title ff-secondary fw-normal text-start text-primary">Phone Number</h5>
                                <p><i class="fa fa-phone-alt me-2"></i><a href="tel:{{ preg_replace('/\s+/', '', config('services.mobile_number')) }}">
                                {{ config('services.mobile_number') }}
                                </a></p>
                            </div>
                        </div>
                    </div>
                   <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                        <div id="map"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                             <!-- Flash Messages -->
                            @if(session('success'))
                                <div class="alert alert-success" style="color: green;">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger" style="color: red;">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form action="{{ route('contact.send') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name">
                                            <label for="name">Your Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">
                                            <label for="email">Your Email</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                                            <label for="subject">Subject</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Leave a message here" name="message" id="message" style="height: 150px"></textarea>
                                            <label for="message">Message</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->


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

        </div>
        <!-- Footer End -->


       <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

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

        <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1XDcdRQ5iaYXE5OeV5Gu6-8Nns8pE8oQ&callback=initMap" async defer></script>

<script>
    let map;
    let marker;

    function initMap() {
        // Get current location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const currentLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                // Create map
                map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 14,
                    center: currentLocation
                });

                // Create marker
                marker = new google.maps.Marker({
                    position: currentLocation,
                    map: map,
                    draggable: true
                });

                // Add listener for marker drag event
                marker.addListener('dragend', function(event) {
                    const newLocation = {
                        lat: event.latLng.lat(),
                        lng: event.latLng.lng()
                    };
                    map.setCenter(newLocation);
                });

                // Add click listener to the map
                map.addListener('click', function(event) {
                    const clickedLocation = {
                        lat: event.latLng.lat(),
                        lng: event.latLng.lng()
                    };
                    marker.setPosition(clickedLocation);
                    map.setCenter(clickedLocation);
                });
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, map.getCenter());
        }
    }

    function handleLocationError(browserHasGeolocation, pos) {
        const errorMsg = browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.';
        alert(errorMsg);
    }
</script>

</body>

</html>