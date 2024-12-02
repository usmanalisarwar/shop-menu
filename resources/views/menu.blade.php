
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>Order And Menu</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    <!-- Flipbook StyleSheet -->
    <link href="{{ asset('dflip/css/dflip.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Icons Stylesheet -->
    <link href="{{ asset('dflip/css/themify-icons.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom Styles to make Flipbook full-screen -->


    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        color: #333;
    }

    /* first section */

      .home{
        padding:1.5rem;
        background:url({{ asset('front-assets/img/background.png')}});

        background-position:center;

        flex-wrap:wrap;
        padding-top:105px;
        padding-bottom:105px;
        background-size:cover;
        background-repeat:no-repeat
      }
      .main-home{
        display:flex;
        justify-content:center;
        align-items:center;
        gap:15px;
      }
      .home-inner-content{
        flex:1 1 45rem;
      }
      .home-image-img{
        width:100%;
      }
      .home-text-content{
        padding:0 8rem:
      }
       .text-importent{
        font-size:55px;
        color:#FEA31B;
        font-family: initial !important;
      }
      .home-text-content p{
        color:white;
        font-size:18px;
        margin-top:10px;
        padding-right:350px;
      }
       .color-a{
        color:#fff;
        padding: 0.6rem 1.5rem;
        border: 1px solid orange;
        border-radius: 10px;

        font-size: 18px;
        transition: 0.5s;
        display: inline-block;
         }
         /* .color-a :hover{

            border:1px solid #fff;
            background-color:#FEA116;
         } */

/* new box shadow */

.item {
    background-color: white;
    border-radius: 8px;
    padding: 15px;
    margin: 10px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease;
    border-radius: 50px;
    width: 162px;
    height: 47px; /* Smooth scaling effect on hover */

}

.item:hover {
    transform: scale(1.05); /* Slightly enlarges box on hover */
}

.black {
    color: #333; /* Text color */
    font-size: 16px;
}

.item.active {
    background-color: #000 /* Active background color */

    /* box-shadow: 0 4px 12px rgba(240, 165, 0, 0.6); Emphasized shadow for active} */
}
.item.active .black {
    color: #FEA116; /* Active text color */
}

/* section 2  pic and menu mean popular&fish */


        .menu {
    max-width: 1450px;
    margin: 55px auto;
    padding: 30px;
}

.menu h2 {
    font-size: 24px;
    margin-bottom: 10px;
    color:#FEA116;
    font-family:initial;
}


.menu p {
    color: #666;
    font-size: 14px;
}

.menu-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px;
}

.menu-item {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform 0.3s;
}

.menu-item:hover {
    transform: scale(1.03);
}

.menu-item img {
    width: 100%;
    height: auto;
}

.item-details {
    padding: 15px;
}

.item-details h3 {
    font-size: 18px;
    margin: 0 0 5px;
}

.price {
    font-weight: bold;
    color: #333;
}

.description {
    font-size: 14px;
    color: #666;
}




/* Owl carsoul start */

.black{
    color:black;
    font-family:initial;
}
.black :hover{
    color:red;
}
.owl-carousel {
    background-color:#FEA116;
    padding:29px 0px;
}
.owl-carousel .owl-stage-outer {
    position: relative;
    overflow: hidden;
    margin: 0 129px;
    -webkit-transform: translate3d(0, 0, 0);}



    .owl-carousel.owl-loaded {
    display: block;
    padding-top: 22px;
    padding-bottom: 94px;
}

/* Hover effect on dots */
.owl-carousel :hover {
    color: #000; /* Change color on hover */
}

.owl-carousel .owl-dot, .owl-carousel .owl-nav .owl-next, .owl-carousel .owl-nav .owl-prev {
    cursor: pointer;
    background-color:#000;}
    .owl-theme .owl-nav [class*=owl-]:hover {
    background: #fff;
    color: #FEA116;
    text-decoration: none;}

    .owl-theme .owl-nav {
    margin-top: 10px;
    display: flex;
    margin:-59px 0px;
    justify-content: space-between ;
   }

@media (max-width: 700px) {
    .home {
        padding: 1rem;
        padding-top: 60px;
        padding-bottom: 60px;
        background-size: cover;
    }
    .img-svg{
        width:95%;
    }

    .main-home {
        flex-direction: column;
        gap: 10px;
    }
    .home-inner-content {
        flex: 1 1 100%;
    }
    .home-text-content {
        padding: 0 2rem;
    }
    .home-text-content p {
        padding-right: 20px;
        font-size: 16px;
    }
    .text-importent {
        font-size: 40px;
        margin-top:55px;
    }
    .menu {
        max-width: 100%;
        padding: 20px;
    }
    .menu h2 {
        font-size: 20px;
    }
    .menu p {
        font-size: 12px;
    }
    .menu-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 10px;
    }
    .owl-carousel .owl-stage-outer {
        margin: 0 96px;
    }
    .owl-theme .owl-nav {
        margin: -53px 0;
    }

    .owl-carousel.owl-loaded {
    display: block;
    padding-top: 11px;
    padding-bottom: 78px;
}
}
    .col-lg-3 {
        /* flex: 0 0 auto; */
        width: 33%;
        padding:0px 80px;
    }

/* By default, hide the subcategories */
.subcategories {
    display: none;
    list-style: none;
    padding: 10px 0;
    margin: 0;
    position: absolute; /* Position it relative to the category */
    top: 100%; /* Align it below the category */
    left: 0;
    background-color: #fff;
    border: 1px solid #ddd;
    z-index: 1000;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

/* The parent item must be positioned relative */
.item {
    position: relative;
}

/* Show subcategories on hover */
.item:hover .subcategories {
    display: block;
}

/* Subcategory link styling */
.subcategories li a {
    text-decoration: none;
    padding: 8px 15px;
    display: block;
    color: #333;
}

.subcategories li a:hover {
    background-color: #f0f0f0;
    color: #000;
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

             <div class="home">
                <div class="main-home">
                    <div class="home-inner-content">
                        <div class="home-image">

                        </div>
                        <img  class="img-svg" src="{{ asset('front-assets/img/background2.png')}}" alt="">
                    </div>

                    <div class="home-inner-content">
                        <div class="home-text-content">
                            <h1 class="text-importent"> Order and Menu elevate Your<br> Dining Experience</h1>

                            <p>Order and Menu, transform your dining experience by crafting unique, delicious menus that showcase your restaurant's style and flavor. </p>
                            <a class="color-a"  href="{{ route('home.contact-us') }}"> Contact Us</a>

                        </div>

                    </div>

                </div>

             </div>

        <!-- <div><input type="text" placeholder="Search in menu"></div> -->
        <div class="owl-carousel owl-theme">
            @foreach($categories as $category)
                <div class="item" data-target="{{ strtolower(str_replace(' ', '-', $category->name)) }}">
                    <h4 class="black">
                        <!-- Link to the category page -->
                        <a href="{{ route('book.show', ['slug' => $menu->slug, 'category_id' => $category->id]) }}">
                            {{ $category->name }}
                        </a>
                    </h4>

                    <!-- Subcategories -->
                    @if($category->children && $category->children->isNotEmpty())
                        <ul class="subcategories">
                            @foreach($category->children as $subcategory)
                                <li>
                                    <!-- Link to the subcategory page -->
                                    <a href="{{ route('book.show', [
                                        'slug' => $menu->slug,
                                        'category_id' => $subcategory->id,
                                        'subcategory_slug' => $subcategory->slug
                                    ]) }}">
                                        {{ $subcategory->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        </div>


    <!-- Display Category Name if Selected -->
    @if(isset($subcategorySlug) && $subcategorySlug)
        <h3>Subcategory Name: {{ $categories->firstWhere('slug', $subcategorySlug)->name }}</h3>
    @elseif($categoryId)
        <h3>Category Name: {{ $categories->firstWhere('id', $categoryId)->name }}</h3>
    @else
        <h3>Showing all items</h3>
    @endif



    <section class="menu">
        <div class="menu-grid">
            @if($menuItems->isEmpty())
                <p>No records found for this category.</p>
            @else
                @foreach($menuItems as $menuItem)
                    <div class="menu-item">
                        @if($menuItem->images->isNotEmpty())
                            <img src="{{ asset('uploads/menuItem/' . $menuItem->images->first()->image) }}" alt="{{ $menuItem->title }}" style="width:200px">
                        @else
                            <img src="{{ asset('path_to_default_image.jpg') }}" alt="Default Image">
                        @endif

                        <div class="item-details">
                            <p class="title">{{ $menuItem->title }}</p>
                            <p class="price">Rs. {{ $menuItem->details->first()->price }}</p>
                            <p class="description">{{ $menuItem->description }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Pagination -->
        <div class="card-footer clearfix">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-end">
                    <li class="page-item {{ $menuItems->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $menuItems->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    @foreach ($menuItems->getUrlRange(1, $menuItems->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $menuItems->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    <li class="page-item {{ $menuItems->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $menuItems->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>


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

        </div>
        <!-- Footer End -->

<!-- jQuery -->
<script src="{{ asset('dflip/js/libs/jquery.min.js')}}" type="text/javascript"></script>
<!-- Flipbook main Js file -->
<script src="{{ asset('dflip/js/dflip.min.js')}}" type="text/javascript"></script>
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

    <script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,  // Enable nav
        // navText: ['<div class="slick-arrow prev"><span class="fa fa-angle-left"></span></div>','<div class="slick-arrow next"><span class="fa fa-angle-right"></span></div>'],

        // navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'], // Chevron icons
        navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
        dots: false,  // Disable dots
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 7
            }
        }

    });
</script>

<!-- new script  -->
<script>
     $(".owl-carousel .item").click(function(){
      var target = $(this).data("target"); // Get the target number
      $(".content").hide(); // Hide all content divs
      $("#content-" + target).show(); // Show the targeted content div
    });

</script>


    <!-- Template Javascript -->
    <script src="{{ asset('front-assets/js/main.js')}}"></script>

    <script>
function showContent(index) {
    // Hide all content divs
    const contents = document.querySelectorAll('.content-box .content');
    contents.forEach(content => content.style.display = 'none');

    // Show the selected content div
    contents[index].style.display = 'block';

    // Remove active class from all buttons
    const buttons = document.querySelectorAll('.tab-btn');
    buttons.forEach(button => button.classList.remove('active-tab'));

    // Add active class to the clicked button
    buttons[index].classList.add('active-tab');
}

// Show the first content by default
document.addEventListener('DOMContentLoaded', () => showContent(0));
</script>

    <!-- end -->
    <!-- popular and fish script -->

    <script>


    // Show/Hide Sections on Carousel Item Click
    $(".owl-carousel .item").click(function() {
      var target = $(this).data("target"); // Get target section ID

      // Hide all sections and show the targeted section
      $("section.menu").hide();
      $("#" + target).show();
    });

</script>

<!-- for carsul active box -->

<script>

document.querySelectorAll('.item').forEach(item => {
    item.addEventListener('click', () => {
        // Remove 'active' class from all items
        document.querySelectorAll('.item').forEach(i => i.classList.remove('active'));

        // Add 'active' class to the clicked item
        item.classList.add('active');
    });
});
</script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>
