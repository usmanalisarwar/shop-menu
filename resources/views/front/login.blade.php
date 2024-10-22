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
          *,
    *:before,
    *:after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }


    body {
        font-family: 'Open Sans', Helvetica, Arial, sans-serif;
        background: #ffffff;
        
    }
    .food-logo{
     
      width: 20%;
      height: 50%;
      padding-top: 15px;
      padding-bottom: 15px;
      

    }
    .navbar{
      display: flex;
    }
    .navbar-dark .navbar-brand{
      width: 50%;
    }
    .form-2{
      display: none;
    }

    input,
    button {
        border: none;
        outline: none;
        background: none;
        font-family: 'Open Sans', Helvetica, Arial, sans-serif;
    }

    .tip {
        font-size: 20px;
        margin: 40px auto 50px;
        text-align: center;
    }

    .cont {
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        width: 900px;
        height: 550px;
        margin: 0 auto 100px;
        background: #fff;
        box-shadow: -10px -10px 15px rgba(255, 255, 255, 0.3), 10px 10px 15px rgba(70, 70, 70, 0.15), inset -10px -10px 15px rgba(255, 255, 255, 0.3), inset 10px 10px 15px rgba(70, 70, 70, 0.15);
    }

    .form {
        position: relative;
        width: 640px;
        height: 100%;
        -webkit-transition: -webkit-transform 1.2s ease-in-out;
        transition: -webkit-transform 1.2s ease-in-out;
        transition: transform 1.2s ease-in-out;
        transition: transform 1.2s ease-in-out, -webkit-transform 1.2s ease-in-out;
        padding: 50px 30px 0;
        
    }
    @media only screen and(max-width:600px){
      .cont.s--signup .img__btn span.m--in {
        -webkit-transform: translateY(0);
        transform: translateY(0);
    }
    }

    @media only screen and (max-width: 600px) {
      .cont{
        width: 400px;
      }
        
      }


    @media only screen and (max-width: 600px) {
      .form{
        width: 386px;
        
      }

    }

    .sub-cont {
        overflow: hidden;
        position: absolute;
        left: 640px;
        top: 0;
        width: 900px;
        height: 100%;
        padding-left: 260px;
        background: #fff;
        -webkit-transition: -webkit-transform 1.2s ease-in-out;
        transition: -webkit-transform 1.2s ease-in-out;
        transition: transform 1.2s ease-in-out;
        transition: transform 1.2s ease-in-out, -webkit-transform 1.2s ease-in-out;
    }

    .cont.s--signup .sub-cont {
        -webkit-transform: translate3d(-640px, 0, 0);
        transform: translate3d(-640px, 0, 0);
    }

    button {
        display: block;
        margin: 0 auto;
        width: 260px;
        height: 36px;
        border-radius: 30px;
        color: #fff;
        font-size: 15px;
        cursor: pointer;
    }

    .img {
        overflow: hidden;
        z-index: 2;
        position: absolute;
        left: 0;
        top: 0;
        width: 260px;
        height: 100%;
        padding-top: 360px;
    }

    .img:after {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: #FEA116;
    }

    .cont.s--signup .img:before {
        -webkit-transform: translate3d(640px, 0, 0);
        transform: translate3d(640px, 0, 0);
    }

    .img__text {
        z-index: 2;
        position: absolute;
        left: 0;
        top: 50px;
        width: 100%;
        padding: 0 20px;
        text-align: center;
        color: #fff;
        -webkit-transition: -webkit-transform 1.2s ease-in-out;
        transition: -webkit-transform 1.2s ease-in-out;
        transition: transform 1.2s ease-in-out;
        transition: transform 1.2s ease-in-out, -webkit-transform 1.2s ease-in-out;
    }

    .img__text h2 {
        margin-bottom: 10px;
        font-weight: normal;
    }

    .img__text p {
        font-size: 14px;
        line-height: 1.5;
    }

    .cont.s--signup .img__text.m--up {
        -webkit-transform: translateX(520px);
        transform: translateX(520px);
    }

    .img__text.m--in {
        -webkit-transform: translateX(-520px);
        transform: translateX(-520px);
    }

    .cont.s--signup .img__text.m--in {
        -webkit-transform: translateX(0);
        transform: translateX(0);
    }

    .img__btn {
        overflow: hidden;
        z-index: 2;
        position: relative;
        width: 100px;
        height: 36px;
        margin: 0 auto;
        background: transparent;
        color: #fff;
        text-transform: uppercase;
        font-size: 15px;
        cursor: pointer;
    }

    .img__btn:after {
        content: '';
        z-index: 2;
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        border: 2px solid #fff;
        border-radius: 30px;
    }

    .img__btn span {
        position: absolute;
        left: 0;
        top: 0;
        display: -webkit-box;
        display: flex;
        -webkit-box-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        align-items: center;
        width: 100%;
        height: 100%;
        -webkit-transition: -webkit-transform 1.2s;
        transition: -webkit-transform 1.2s;
        transition: transform 1.2s;
        transition: transform 1.2s, -webkit-transform 1.2s;
    }

    .img__btn span.m--in {
        -webkit-transform: translateY(-72px);
        transform: translateY(-72px);
    }

    .cont.s--signup .img__btn span.m--in {
        -webkit-transform: translateY(0);
        transform: translateY(0);
    }

    .cont.s--signup .img__btn span.m--up {
        -webkit-transform: translateY(72px);
        transform: translateY(72px);
    }

    h2 {
        width: 100%;
        font-size: 26px;
        text-align: center;
    }

    label {
        display: block;
        width: 260px;
        margin: 8px auto 0;
        text-align: center;
    }

    label span {
        font-size: 12px;
        color: #cfcfcf;
        text-transform: uppercase;
    }

    input {
        display: block;
        width: 100%;
        margin-top: 5px;
        padding-bottom: 5px;
        font-size: 16px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.4);
        text-align: center;
    }

    .forgot-pass {
        margin-top: 15px;
        text-align: center;
        font-size: 12px;
        color: #cfcfcf;
        margin-left: 246px;
    }

    .submit {
        margin-top: 40px;
        margin-bottom: 20px;
        background: #FEA116;
        text-transform: uppercase;
    }

    .fb-btn {
        border: 2px solid #d3dae9;
        color: #8fa1c7;
    }

    .fb-btn span {
        font-weight: bold;
        color: #455a81;
    }

    .sign-in {
        -webkit-transition-timing-function: ease-out;
        transition-timing-function: ease-out;
    }

    .cont.s--signup .sign-in {
        -webkit-transition-timing-function: ease-in-out;
        transition-timing-function: ease-in-out;
        -webkit-transition-duration: 1.2s;
        transition-duration: 1.2s;
        -webkit-transform: translate3d(640px, 0, 0);
        transform: translate3d(640px, 0, 0);
    }

    .sign-up {
        -webkit-transform: translate3d(-900px, 0, 0);
        transform: translate3d(-900px, 0, 0);
    }

    .cont.s--signup .sign-up {
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
        margin-top: -50px;
    }
    /* .submit{
      display: none;
    } */

    .submit-1{
      display: none;
      color: #ffffff;
      margin-top: 40px;
        margin-bottom: 20px;
        background: #FEA116;
        text-transform: uppercase;
    }
    p{
      display: flex;
    }
    a{
      color:#FEA116 ;
      text-decoration: underline;
    }
    .margin-left{
      margin-left: 10px;
      display: none;
    }
    .p15{
      display: none;
    }
    .margin-right{
      display: none;
      padding-top: 15px;
    }
    .display-none{
      display: none;
    }
    @media only screen and (max-width: 600px) {
      .cont {
          width: 90%; /* Full width for mobile */
          height: auto; /* Auto height for content */
      }
      .forgot-pass {
        margin-top: 15px;
        margin-left: 116px;
        font-size: 12px;
        color: #cfcfcf;
       
    }

      .p15{
        display: block;
      }
      .margin-right{
        display: block;
        padding-top: 15px;
      }
      .margin-left{
        display: block;
      }
      .display-none{
        display: block;
      }

      .form {
          width: 100%; /* Full width for forms */
          padding-bottom: 15px;
      }

      .img {
          padding-top: 50px; /* Adjust padding for mobile */
      }

      .img__btn {
          width: 80%; /* Full width for button */
      }

      .img__text {
          padding: 0 10px; /* Adjust padding for mobile */
      }

      label {
          width: 90%; /* Full width for labels */
      }

      input {
          width: 90%; /* Full width for inputs */
      }

      .img:after {
        content: '';
        position: relative;
        left: 0;
        top: 0;
        width: 50%;
        height: 50%;
        background: rgba(0, 0, 0, 0.6);
    }
    .submit-1{
      display: block;
    }

    .food-logo{
     
      width: 100%;
      height: 100%;
      padding-top: 15px;
      padding-bottom: 15px;
      

    }
    .navbar-dark .navbar-brand{
      width: 90px;
    }
    .navbar-dark .navbar-toggler{
      margin-right: 3%;
      
     
     
      border-radius: 2px;
      transition: box-shadow 0.15s ease-in-out;
      
    }
    .navbar{
      height: 95%;
    }
    /* .form-2{
      display: block;
    } */

    }
    .navbar-dark .navbar-toggler{
      width: 50%;
    }


    @media (max-width: 768px) {
      #sign-up-form {
          display: none; /* Hide sign-up form initially */
      }
    }
  /* Your existing styles */
        body {
            font-family: 'Open Sans', Helvetica, Arial, sans-serif;
            background: #ffffff;
        }

        /* Add your other styles here */
    </style>
     <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1XDcdRQ5iaYXE5OeV5Gu6-8Nns8pE8oQ&callback=initMap" async defer></script>
    <script>
function initMap() {
    // Set default center
    const mapOptions = {
        zoom: 8,
    };

    // Initialize the map for desktop
    const map = new google.maps.Map(document.getElementById("map"), mapOptions);
    const marker = new google.maps.Marker({
        map: map,
        title: "Your Location",
    });

    // Initialize the map for mobile
    const mobileMap = new google.maps.Map(document.getElementById("map-mobile"), mapOptions);
    const mobileMarker = new google.maps.Marker({
        map: mobileMap,
        title: "Your Location",
    });

    // Function to update marker position and hidden fields
    function updateLocation(position) {
        const userLocation = {
            lat: position.lat(),
            lng: position.lng(),
        };

        // Update marker positions
        marker.setPosition(userLocation);
        mobileMarker.setPosition(userLocation);

        // Set the hidden fields with the selected location
        document.getElementById("latitude").value = userLocation.lat;
        document.getElementById("longitude").value = userLocation.lng;
        document.getElementById("latitude-mobile").value = userLocation.lat;
        document.getElementById("longitude-mobile").value = userLocation.lng;
    }

    // Try to get the user's current location
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                // Set the map center to user's location
                map.setCenter(userLocation);
                marker.setPosition(userLocation);
                
                mobileMap.setCenter(userLocation);
                mobileMarker.setPosition(userLocation);

                // Set the hidden fields with the current location
                updateLocation({ lat: () => userLocation.lat, lng: () => userLocation.lng });
            },
            () => {
                handleLocationError(true, map);
            }
        );
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, map);
    }

    // Add click event to the desktop map
    map.addListener("click", (event) => {
        updateLocation(event.latLng);
    });

    // Add click event to the mobile map
    mobileMap.addListener("click", (event) => {
        updateLocation(event.latLng);
    });
}

function handleLocationError(browserHasGeolocation, map) {
    const infoWindow = new google.maps.InfoWindow({
        content: browserHasGeolocation
            ? "Error: The Geolocation service failed."
            : "Error: Your browser doesn't support geolocation.",
    });
    infoWindow.setPosition(map.getCenter());
    infoWindow.open(map);
}


</script>

</head>

<body>
    <div class="bg-white p-0">
    </div>
      
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

        <br><br>
        <div class="cont">
            <div class="form sign-in">
                <h2>Welcome</h2>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif <!-- Fixed this part -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="sign-up" method="POST" action="{{ route('login') }}">
                    @csrf
                    <label>
                        <span>Email</span>
                        <input type="email" name="email" required />
                    </label>
                    <label>
                        <span>Password</span>
                        <input type="password" name="password" required />
                    </label>
                    <p class="forgot-pass">
                        <a href="{{ route('password.request') }}">Forgot password?</a>
                    </p>
                    <button type="submit" class="submit">Sign In</button>
                    <p class="display-none">Don't have an account? <a class="margin-left" href="#" id="sign-up-btn" onclick="showSignupForm()">Sign Up</a></p>
                </form>

                <div>
                    <!-- Mobile Only Form -->
                    <form class="form-2" id="sign-in" method="POST" action="{{ route('register') }}">
                        @csrf
                        <label>
                            <span>Name</span>
                            <input type="text" name="name" required />
                        </label>
                        <label>
                            <span>Email</span>
                            <input type="email" name="email" required />
                        </label>
                        <label>
                            <span>Company Name</span>
                            <input type="text" name="company_name" required />
                        </label>
                        <label>
                            <span>Password</span>
                            <input type="password" name="password" required />
                        </label>
                        <label>
                            <span>Confirm Password</span>
                            <input type="password" name="password_confirmation" required />
                        </label>
                          <!-- Add the map div here -->
                        <div id="map-mobile" style="height: 140px; width: 100%; margin-bottom: 20px;"></div>
                        <input type="hidden" name="latitude" id="latitude-mobile" />
                        <input type="hidden" name="longitude" id="longitude-mobile" />
                        <button type="submit" class="submit-1">Sign Up</button>
                        <p class="p15">If you already have an account, just sign in?</p>
                        <a class="margin-right" href="#" id="sign-in-btn" onclick="showSigninForm()">Sign in</a>
                    </form>
                </div>
            </div>

            <div class="sub-cont">
                <div class="img">
                    <div class="img__text m--up">
                        <h3>Don't have an account? Please Sign up!</h3>
                    </div>
                    <div class="img__text m--in">
                        <h3>If you already have an account, just sign in.</h3>
                    </div>
                    <div class="img__btn">
                        <span class="m--up">Sign Up</span>
                        <span class="m--in">Sign In</span>
                    </div>
                </div>

                <div class="form sign-up">
                    <h2>Create your Account</h2>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <label>
                            <span>Name</span>
                            <input type="text" name="name" required />
                        </label>
                        <label>
                            <span>Email</span>
                            <input type="email" name="email" required />
                        </label>
                        <label>
                            <span>Company Name</span>
                            <input type="text" name="company_name" required />
                        </label>
                        <label>
                            <span>Password</span>
                            <input type="password" name="password" required />
                        </label>
                        <label>
                            <span>Confirm Password</span>
                            <input type="password" name="password_confirmation" required />
                        </label>
                          <!-- Other form fields -->
                        <div id="map" style="height: 140px; width: 500px; margin-bottom: 20px; margin-top: 2px;"></div>
                        <input type="hidden" name="latitude" id="latitude" />
                        <input type="hidden" name="longitude" id="longitude" />
                        <button type="submit" class="submit" style="margin-top: -18px;">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function showSignupForm() {
                document.getElementById("sign-up").style.display = "none";
                document.getElementById("sign-in").style.display = "block";
            }
            function showSigninForm() {
                document.getElementById("sign-in").style.display = "none";
                document.getElementById("sign-up").style.display = "block";
            }
            document.querySelector('.img__btn').addEventListener('click', function() {
                document.querySelector('.cont').classList.toggle('s--signup');
            });
        </script>
    </div>
</body>

</html>