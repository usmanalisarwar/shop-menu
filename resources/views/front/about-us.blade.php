<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order And Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('front-assets/css/order.css') }}">
    
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
                    <!-- <li class="nav-item"><a class="nav-link fs-5 fw-semibold" href="qr.html">QR Code</a></li> -->
                    <li class="nav-item"><a class="nav-link fs-5 fw-semibold" href="blog.html">Blog</a></li>
                    <li class="nav-item"><a class="nav-link fs-5 fw-semibold" href="{{ route('home.contact-us')}}">Contact Us</a></li>
                </ul> 
            <a href="#" class="btn btn-dark rounded-pill">Get Free Quote</a>
        </div>
    </div>
</nav>

<div class="d-flex align-items-center justify-content-center position-relative" style="background-color: #FFF8F6; height: 400px;">
    <!-- <div class="position-absolute top-50 start-50 translate-middle text-uppercase fw-bold text-black-50 responsive-text">
        About Us
    </div> -->
    <div class="container position-relative text-center">
        <h1 class="fw-bold text-dark  " style="font-size:56px; font-weight: 700;">About-Us </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ route('home.index')}}" class="text-danger text-decoration-none ">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">About-Us</li>
            </ol>
        </nav>
    </div>
</div>

<section class="about-section py-5 position-relative bg-white overflow-hidden">
    <!-- Background faded images -->
    <!-- <img src="path/to/food-bg-left.png" class="position-absolute opacity-10 w-40 start-0 top-0" alt="">
    <img src="path/to/food-bg-right.png" class="position-absolute opacity-10 w-40 end-0 bottom-0" alt=""> -->
    
    <div class="container">
        <div class="row align-items-center">
            <!-- Left side images with exact positioning -->
            <div class="col-lg-5 mb-4 mb-lg-0 position-relative">
                <div class="position-relative" style="height: 450px; width: 100%;">
                    <div class="position-absolute top-0 start-0 w-75 h-65 rounded overflow-hidden z-1">
                        <img src="{{asset('front-assets/new_img/2.png')}}" class="w-100 h-100 object-fit-cover" alt="Delicious food">
                    </div>
                    <div class="position-absolute bottom-0 end-0 w-75 h-65 rounded overflow-hidden z-2">
                        <img src="{{asset('front-assets/new_img/1.png')}}" class="w-100 h-100 object-fit-cover png-1 " alt="Our chef">
                    </div>
                </div>
            </div>
            
            <!-- Right side content -->
            <div class="col-lg-6 ps-lg-5 ms-lg-5">
                <p class="text-uppercase text-danger fw-bold small mb-2">About Us</p>
                <h2 class="fw-bold text-dark fs-2 mb-3">Variety of flavours from American cuisine</h2>
                <p class="text-secondary lh-lg mb-4 fw-normal">Every dish is not just prepared, it's crafted with utmost precision and a deep understanding of flavor harmony by our experienced chefs.</p>
                
                <!-- Features -->
                <div class="row mt-4 mb-4">
                    <!-- Super Quality Food -->
                    <div class="col-md-6 mb-3 d-flex">
                        <div class="me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#d9534f" class="bi bi-award" viewBox="0 0 16 16">
                                <path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z"/>
                                <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="fw-semibold fs-5">Super Quality Food</h4>
                            <p class="text-secondary small">Served our Tasty Food & good test by Homely</p>
                        </div>
                    </div>
                    
                    <!-- Qualified Chef -->
                    <div class="col-md-6 mb-3 d-flex">
                        <div class="me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#d9534f" class="bi bi-person-check" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                                <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="fw-semibold fs-5">Qualified Chef</h4>
                            <p class="text-secondary small">Served our Tasty Food & good test by Homely</p>
                        </div>
                    </div>
                </div>
                
                <!-- Read More button -->
                <div class="mt-4">
                    <button class="btn btn-danger rounded-pill px-4 py-2 text-white fw-medium">Read More</button>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- testimonial section start -->

<section class="testimonial-section py-5 mb-lg-5" style="background-color: #FFF8F6;">
    <div class="container">
        <div class="text-center mb-5">
            <div class="d-flex justify-content-center align-items-center mb-2">
                <div class="bg-danger" style="height: 2px; width: 40px;"></div>
                <h6 class="text-danger mx-2 mb-0 fw-semibold">Our Testimonials</h6>
                <div class="bg-danger" style="height: 2px; width: 40px;"></div>
            </div>
            <h2 class="fw-bold fs-1 text-dark">What Our Customers Says!</h2>
        </div>
        
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                <!-- First slide -->
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 mb-4 mb-md-0">
                            <div class="card border-0 shadow-sm h-100 m-2 p-4 position-relative transition">
                                <i class="fas fa-quote-right position-absolute top-0 end-0 m-3 fs-1 text-danger opacity-10"></i>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3">
                                        <img src="{{asset('front-assets/new_img/2.png')}}" alt="John Brown" class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;">
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-0 text-dark">John Brown</h5>
                                        <span class="text-danger small">BPO Manager</span>
                                    </div>
                                </div>
                                <p class="fst-italic text-secondary">
                                    There cursus massa at urnaaculis estie. Sed aliquamellus vitae ultrs condmentum leo massa mollis estiegittis mirutm nulla sed meody fringilla vitae.
                                </p>
                                <div class="text-warning mt-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 d-none d-md-block">
                            <div class="card border-0 shadow-sm h-100 m-2 p-4 position-relative transition">
                                <i class="fas fa-quote-right position-absolute top-0 end-0 m-3 fs-1 text-danger opacity-10"></i>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3">
                                        <img src="{{asset('front-assets/new_img/4.jpg')}}" alt="John Brown" class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;">
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-0 text-dark">John Brown</h5>
                                        <span class="text-danger small">BPO Manager</span>
                                    </div>
                                </div>
                                <p class="fst-italic text-secondary">
                                    There cursus massa at urnaaculis estie. Sed aliquamellus vitae ultrs condmentum leo massa mollis estiegittis mirutm nulla sed meody fringilla vitae.
                                </p>
                                <div class="text-warning mt-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Second slide -->
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 mb-4 mb-md-0">
                            <div class="card border-0 shadow-sm h-100 m-2 p-4 position-relative transition">
                                <i class="fas fa-quote-right position-absolute top-0 end-0 m-3 fs-1 text-danger opacity-10"></i>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3">
                                        <img src="{{asset('front-assets/new_img/5.jpg')}}" alt="Sarah Smith" class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;">
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-0 text-dark">Sarah Smith</h5>
                                        <span class="text-danger small">Marketing Director</span>
                                    </div>
                                </div>
                                <p class="fst-italic text-secondary">
                                    There cursus massa at urnaaculis estie. Sed aliquamellus vitae ultrs condmentum leo massa mollis estiegittis mirutm nulla sed meody fringilla vitae.
                                </p>
                                <div class="text-warning mt-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 d-none d-md-block">
                            <div class="card border-0 shadow-sm h-100 m-2 p-4 position-relative transition">
                                <i class="fas fa-quote-right position-absolute top-0 end-0 m-3 fs-1 text-danger opacity-10"></i>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3">
                                        <img src="{{asset('front-assets/new_img/6.jpg')}}" alt="Michael Johnson" class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;">
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-0 text-dark">Michael Johnson</h5>
                                        <span class="text-danger small">IT Specialist</span>
                                    </div>
                                </div>
                                <p class="fst-italic text-secondary">
                                    There cursus massa at urnaaculis estie. Sed aliquamellus vitae ultrs condmentum leo massa mollis estiegittis mirutm nulla sed meody fringilla vitae.
                                </p>
                                <div class="text-warning mt-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Third slide -->
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 mb-4 mb-md-0">
                            <div class="card border-0 shadow-sm h-100 m-2 p-4 position-relative transition">
                                <i class="fas fa-quote-right position-absolute top-0 end-0 m-3 fs-1 text-danger opacity-10"></i>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3">
                                        <img src="{{asset('front-assets/new_img/7.jpg')}}" alt="Emily Davis" class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;">
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-0 text-dark">Emily Davis</h5>
                                        <span class="text-danger small">Product Manager</span>
                                    </div>
                                </div>
                                <p class="fst-italic text-secondary">
                                    There cursus massa at urnaaculis estie. Sed aliquamellus vitae ultrs condmentum leo massa mollis estiegittis mirutm nulla sed meody fringilla vitae.
                                </p>
                                <div class="text-warning mt-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 d-none d-md-block">
                            <div class="card border-0 shadow-sm h-100 m-2 p-4 position-relative transition">
                                <i class="fas fa-quote-right position-absolute top-0 end-0 m-3 fs-1 text-danger opacity-10"></i>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3">
                                        <img src="{{asset('front-assets/new_img/8.jpg')}}" alt="David Wilson" class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;">
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-0 text-dark">David Wilson</h5>
                                        <span class="text-danger small">CEO</span>
                                    </div>
                                </div>
                                <p class="fst-italic text-secondary">
                                    There cursus massa at urnaaculis estie. Sed aliquamellus vitae ultrs condmentum leo massa mollis estiegittis mirutm nulla sed meody fringilla vitae.
                                </p>
                                <div class="text-warning mt-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Navigation arrows -->
            <button class="carousel-control-prev bg-danger rounded-circle" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev" style="width: 40px; height: 40px; left: -20px; top: 50%; transform: translateY(-50%); opacity: 0.7;">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next bg-danger rounded-circle" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next" style="width: 40px; height: 40px; right: -20px; top: 50%; transform: translateY(-50%); opacity: 0.7;">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            
            <!-- Indicators -->
            <div class="carousel-indicators position-relative" style="bottom: -50px;">
                <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="active bg-danger" aria-current="true" aria-label="Slide 1" style="width: 12px; height: 12px; border-radius: 50%; opacity: 0.5;"></button>
                <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1" aria-label="Slide 2" class="bg-danger" style="width: 12px; height: 12px; border-radius: 50%; opacity: 0.5;"></button>
                <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="2" aria-label="Slide 3" class="bg-danger" style="width: 12px; height: 12px; border-radius: 50%; opacity: 0.5;"></button>
            </div>
        </div>
    </div>
</section>
<!-- testimonial section end -->

<footer class="bg-dark text-light pt-5 ">
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
            <li><a href="#" class="text-light text-decoration-none">Home</a></li>
            <li><a href="#" class="text-light text-decoration-none">About Us</a></li>
            <li><a href="#" class="text-light text-decoration-none">Menu</a></li>
            <li><a href="#" class="text-light text-decoration-none">Blog</a></li>
            <li><a href="#" class="text-light text-decoration-none">Contact Us</a></li>
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
  
  


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>

</body>
</html>
