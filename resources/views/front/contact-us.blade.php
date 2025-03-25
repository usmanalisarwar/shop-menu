<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order And Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Set the height of the map */
        #map {
            height: 350px; /* Adjust as needed */
            width: 100%;
        }
        .about-banner {
            background: url("{{ asset('front-assets/new_img/banners.jpg') }}") no-repeat center center/cover;
        }
        .breadcrumb-item+.breadcrumb-item::before {
            color: white; /* Turns the slash ( / ) white */
        }
    </style>
</head>
<body>  

<!-- Top Bar -->
<div class="py-2" style="background-color: #e64343;">
    <div class="container d-flex justify-content-between align-items-center flex-nowrap top-bar">
        <div class="d-flex align-items-center flex-nowrap">
            <a href="tel:+13055441225" class="text-white me-3"><i class="fas fa-phone-alt me-2"></i> +1 (305) 544-1225</a>
            <a href="mailto:info@gmail.com" class="text-white"><i class="far fa-envelope me-2"></i> info@gmail.com</a>
        </div>
        <div class="d-flex align-items-center">
            <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-white"><i class="fab fa-whatsapp"></i></a>
        </div>
    </div>
</div>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg bg-white ">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home.index') }}">
            <span class="text-black">ORDER AND</span> <span style="color: #e64343;">MENU</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link fs-5 fw-semibold" href="{{ route('home.index')}}">Home</a></li>
                <li class="nav-item"><a class="nav-link fs-5 fw-semibold" href="{{ route('home.about-us')}}">About Us</a></li>
                <li class="nav-item"><a class="nav-link fs-5 fw-semibold" href="{{ route('home.menu') }}">Menu</a></li>
                <li class="nav-item"><a class="nav-link fs-5 fw-semibold" href="blog.html">Blog</a></li>
                <li class="nav-item"><a class="nav-link fs-5 fw-semibold" href="{{ route('home.contact-us')}}">Contact Us</a></li>
            </ul>
            <a href="{{ route('home.login') }}" class="btn btn-dark rounded-pill">Sign In</a>
        </div>
    </div>
</nav>

<div class="d-flex align-items-center justify-content-center position-relative about-banner" style="background-color: #FFF8F6; height: 400px;">
    <div class="container position-relative text-center">
        <h1 class="fw-bold text-white" style="font-size:56px; font-weight: 700;">Contact-Us </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ route('home.index')}}" class="text-danger text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Contact-Us</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Contact Form and Map Section -->
<div class="container-fluid py-5">
    <div class="row py-3 py-md-4 mx-auto" style="max-width: 1200px;">
        <div class="col-md-6 pe-md-4 mb-4 mb-md-0">
            <!-- Flash Messages -->
            <div id="flash-messages">
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
            </div>
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control border-1 rounded-0 py-2" id="name" name="name" placeholder="Your Name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" class="form-control border-1 rounded-0 py-2" id="email" name="email" placeholder="Your Email" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control border-1 rounded-0 py-2" id="phone" name="phone" placeholder="Phone Number" pattern="[0-9]*" inputmode="numeric" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control border-1 rounded-0 py-2" id="message" name="message" rows="5" placeholder="Write Message" required></textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" class="btn w-100 rounded-0 py-2 text-uppercase text-white" style="background-color: #e0352b;">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 ps-md-0">
            <!-- Map Section -->
            <div id="map"></div>
            <!-- <div class="mt-3">
                <p><i class="fas fa-map-marker-alt text-danger me-2"></i> 123 Main Street, Miami, FL 33101, USA</p>
            </div> -->
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-light pt-5">
    <div class="container">
        <div class="row">
            <!-- Logo and Description -->
            <div class="col-md-3 col-sm-6 mb-4">
                <h3>Logo</h3>
                <p>There cursus massa at urnaaculis esteSed aliquamellus vitae ultrs condmentum leo massa mollis estiegittis miristum.</p>
                <div>
                    <a href="#" class="btn btn-danger btn-sm rounded-circle me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-danger btn-sm rounded-circle me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="btn btn-danger btn-sm rounded-circle"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="col-md-3 col-sm-6 mb-4">
                <h4 class="text-danger">Quick Links</h4>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home.index') }}" class="text-light text-decoration-none">Home</a></li>
                    <li><a href="{{ route('home.about-us') }}" class="text-light text-decoration-none">About Us</a></li>
                    <li><a href="{{ route('home.menu') }}" class="text-light text-decoration-none">Menu</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Blog</a></li>
                    <li><a href="{{ route('home.contact-us') }}" class="text-light text-decoration-none">Contact Us</a></li>
                </ul>
            </div>
            
            <!-- Useful Links -->
            <div class="col-md-3 col-sm-6 mb-4">
                <h4 class="text-danger">Useful Links</h4>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-light text-decoration-none">Privacy Policy</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Terms and Conditions</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Disclaimer</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Support</a></li>
                    <li><a href="#" class="text-light text-decoration-none">FAQ</a></li>
                </ul>
            </div>
            
            <!-- Contact Us -->
            <div class="col-md-3 col-sm-6 mb-4">
                <h4 class="text-danger">Contact Us</h4>
                <ul class="list-unstyled">
                    <li class="pb-3"><i class="fas fa-map-marker-alt text-danger me-2"></i> Northern Territory 0862 North Australia</li>
                    <li class="pb-3"><i class="fas fa-phone-alt text-danger me-2"></i> (+91) 9999 8888 666</li>
                    <li class="pb-3"><i class="far fa-clock text-danger me-2"></i> 24/7 Hours Service</li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Copyright -->
    <div class="bg-danger text-center py-3">
        <p class="mb-0">Copyright &copy; 2025 All Rights Reserved.</p>
    </div>
</footer>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>

<!-- Google Maps API -->
<script>
    function initMap() {
        // Default location (Miami, FL)
        const defaultLocation = { lat: 25.7617, lng: -80.1918 };
        
        // Create map centered at default location
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
            center: defaultLocation,
            styles: [
                {
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#444444"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#f2f2f2"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 45
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#e64343"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                }
            ]
        });
        
        // Add marker
        const marker = new google.maps.Marker({
            position: defaultLocation,
            map: map,
            title: "Our Location",
            icon: {
                url: "https://maps.google.com/mapfiles/ms/icons/red-dot.png"
            }
        });
        
        // Info window
        const infoWindow = new google.maps.InfoWindow({
            content: "<h5>Our Restaurant</h5><p>123 Main Street, Miami, FL</p>"
        });
        
        marker.addListener("click", () => {
            infoWindow.open(map, marker);
        });
        
        // Try HTML5 geolocation to center map on user's location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    
                    // Add user location marker
                    new google.maps.Marker({
                        position: userLocation,
                        map: map,
                        title: "Your Location",
                        icon: {
                            url: "https://maps.google.com/mapfiles/ms/icons/blue-dot.png"
                        }
                    });
                    
                    // Fit bounds to show both locations
                    const bounds = new google.maps.LatLngBounds();
                    bounds.extend(defaultLocation);
                    bounds.extend(userLocation);
                    map.fitBounds(bounds);
                },
                () => {
                    // If geolocation fails, just use default location
                    handleLocationError(true, map.getCenter());
                }
            );
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, map.getCenter());
        }
    }
    
    function handleLocationError(browserHasGeolocation, pos) {
        console.log(browserHasGeolocation ?
            "Error: The Geolocation service failed." :
            "Error: Your browser doesn't support geolocation.");
    }
</script>

<!-- Load Google Maps API with your API key -->
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
</script>
</body>
</html>