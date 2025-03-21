<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order And Menu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="order.css">
  <style>
    /* Mobile-specific styles */
    @media (max-width: 767.98px) {
      .container {
        position: relative;
        padding: 20px;
      }

      .container img:first-child {
        height: auto;
        max-width: 100%;
      }

      .container img.position-absolute {
        height: 100px;
        width: 100px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
      }
    }

    /* Print-specific styles */
    @media print {
      body * {
        visibility: hidden; /* Hide everything by default */
      }

      h1,
      h5,
      .qr-container,
      .qr-container * { /* Ensure the QR code and its children are visible */
        visibility: visible !important;
      }

      h1 {
        text-align: center;
        font-size: 55px;
        margin: -70px auto 0 auto;
      }

      h5 {
        text-align: center;
        font-size: 18px;
        margin-top: 20px;
      }

      .qr-container {
        display: block !important;
        position: absolute;
        top: 60% !important;
        left: 52% !important;
        transform: translate(-50%, -50%) !important;
        z-index: 2;
      }

      .qr-container svg {
        width: 200px !important;
        height: 200px !important;
      }
    }

    /* QR Code Positioning */
    .qr-container {
      position: absolute;
      top: 60%; /* Adjust this value to position the QR code vertically */
      left: 52%; /* Adjust this value to position the QR code horizontally */
      transform: translate(-50%, -50%);
      z-index: 2;
    }

    .qr-container svg {
      width: 200px !important; /* Adjust QR code size */
      height: 200px !important;
    }

    @media (max-width: 768px) {
      .qr-container {
        top: 50%; /* Adjust for mobile */
        left: 50%;
        transform: translate(-50%, -50%);
      }

      .qr-container svg {
        width: 150px !important; /* Smaller QR code for mobile */
        height: 150px !important;
      }
    }

    @media (max-width: 480px) {
      .qr-container {
        top: 45%; /* Adjust for smaller screens */
        left: 50%;
        transform: translate(-50%, -50%);
      }

      .qr-container svg {
        width: 120px !important; /* Even smaller QR code for small devices */
        height: 120px !important;
      }
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
  <nav class="navbar navbar-expand-lg bg-white">
    <div class="container">
      <a class="navbar-brand fw-bold" href="{{ route('home.index') }}">
        <span class="text-black">ORDER AND</span> <span style="color: #e64343;">MENU</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
        <li class="nav-item"><a class="nav-link fs-5 fw-semibold" href="{{ route('home.index')}}">Home</a></li>
                    <li class="nav-item"><a class="nav-link fs-5 fw-semibold" href="{{ route('home.about-us')}}">About Us</a></li>
                    <li class="nav-item"><a class="nav-link fs-5 fw-semibold" href="{{ route('home.menu') }}">Menu</a></li>
                    <!-- <li class="nav-item"><a class="nav-link fs-5 fw-semibold" href="qr.html">QR Code</a></li> -->
                    <li class="nav-item"><a class="nav-link fs-5 fw-semibold" href="blog.html">Blog</a></li>
                    <li class="nav-item"><a class="nav-link fs-5 fw-semibold" href="{{ route('home.contact-us')}}">Contact Us</a></li>
                </ul>
        <a href="#" class="btn btn-dark rounded-pill">Get Free Quote</a>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="py-5" style="background-color: #FFF8F6;">
    <div>
      <h1 class="text-center pb-3">Another Restaurant</h1>
    </div>
    <div class="container d-flex align-items-center justify-content-center position-relative">
      <!-- Menu Image -->
      @if ($menuImage)
      <img src="{{ asset('uploads/menu/' . $menuImage->image) }}" class="img-fluid object-fit-cover" alt="Menu Image" style="height: 550px; width: 500px;">
      @else
      <img src="{{ asset('uploads/menu/default.jpg') }}" class="img-fluid object-fit-cover" alt="Default Image" style="height: 550px; width: 500px;">
      @endif

      <!-- QR Code -->
      <div class="qr-container">
        {!! $qrCode !!}
      </div>
    </div>
    <h5 class="text-center pt-3">Scan to open menu</h5>
    <div class="text-center text-uppercase">
      <p><a class="text-decoration-none text-black fw-semibold" href="{{route('home.menu')}}">Click Here To
          Menu</a></p>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-dark text-light pt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-6 mb-4">
          <h3>Logo</h3>
          <p>There cursus massa at urnaaculis esteSed aliquamellus vitae ultrs condmentum leo massa mollis estiegittis
            miristum.</p>
          <div>
            <a href="#" class="btn btn-danger btn-sm rounded-circle me-2"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="btn btn-danger btn-sm rounded-circle me-2"><i class="fab fa-twitter"></i></a>
            <a href="#" class="btn btn-danger btn-sm rounded-circle"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
          <h4 class="text-danger">Quick Links</h4>
          <ul class="list-unstyled">
            <li><a href="#" class="text-light text-decoration-none">Home</a></li>
            <li><a href="#" class="text-light text-decoration-none">About Us</a></li>
            <li><a href="#" class="text-light text-decoration-none">Menu</a></li>
            <li><a href="#" class="text-light text-decoration-none">Blog</a></li>
            <li><a href="#" class="text-light text-decoration-none">Contact Us</a></li>
          </ul>
        </div>
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
        <div class="col-md-3 col-sm-6 mb-4">
          <h4 class="text-danger">Contact Us</h4>
          <ul class="list-unstyled">
            <li class="pb-3"><i class="fas fa-map-marker-alt text-danger me-2"></i> Northern Territory 0862 North
              Australia</li>
            <li class="pb-3"><i class="fas fa-phone-alt text-danger me-2"></i> (+91) 9999 8888 666</li>
            <li class="pb-3"><i class="far fa-clock text-danger me-2"></i> 24/7 Hours Service</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="bg-danger text-center py-3">
      <p class="mb-0">Copyright &copy; 2025 All Rights Reserved.</p>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>
  <script>
    document.addEventListener("keydown", function (event) {
      if (event.ctrlKey && event.key === "p") {
        event.preventDefault();
        setTimeout(() => {
          window.print();
        }, 100);
      }
    });
  </script>
</body>

</html>