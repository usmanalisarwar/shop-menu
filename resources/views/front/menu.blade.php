<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order And Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('front-assets/css/order.css') }}">
    <style>
        .menu-item {
            transition: transform 0.3s;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .menu-item:hover {
            transform: scale(1.03);
        }

        .menu-image {
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        .category-sidebar {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
        }

        .category-link {
            color: #333;
            text-decoration: none;
            display: block;
            padding: 8px 0;
            transition: color 0.2s;
            cursor: pointer;
        }

        .category-link:hover,
        .category-link.active {
            color: #ff6b6b;
            font-weight: bold;
        }

        .subcategory-container {
            padding-left: 15px;
            display: none;
        }

        .subcategory-item {
            display: block;
            padding: 5px 0;
            color: #555;
            text-decoration: none;
            cursor: pointer;
            transition: color 0.2s;
        }

        .subcategory-item:hover {
            color: #ff6b6b;
            font-weight: bold;
        }

        .stars {
            color: #ffc107;
        }

        #categoryTitle {
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        /* Offcanvas styling for mobile */
        .offcanvas-custom {
            width: 250px !important;
            /* Adjust width as needed */
        }

        .category-item {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
        }

        .subcategory-list {
            margin-left: 20px;
            display: none;
        }

        #loading {
            text-align: center;
            font-size: 18px;
            display: none;
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
                    <!-- <li class="nav-item"><a class="nav-link fs-5 fw-semibold" href="qr.html">QR Code</a></li> -->
                    <li class="nav-item"><a class="nav-link fs-5 fw-semibold" href="blog.html">Blog</a></li>
                    <li class="nav-item"><a class="nav-link fs-5 fw-semibold" href="{{ route('home.contact-us')}}">Contact Us</a></li>
                </ul>
                <a href="#" class="btn btn-dark rounded-pill">Get Free Quote</a>
            </div>
        </div>
    </nav>

    <!-- banner start -->


    <div class="d-flex align-items-center justify-content-center position-relative" style="background-color: #FFF8F6; height: 400px;">
        <!-- <div class="position-absolute top-50 start-50 translate-middle text-uppercase fw-bold text-black-50 responsive-text">
        Our Menu
    </div> -->
        <div class="container position-relative text-center">
            <h1 class="fw-bold text-dark" style="font-size:5rem;">Menu</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}" class="text-danger text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Menu</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- menu start -->
    <div class="container pb-5">
        <div class="row py-4"></div>

        <div class="row">
            <div class="col-lg-3">
                @foreach ($categories as $category)
                @if($category->parent_id == null)
                <div class="category-link" data-bs-toggle="collapse" data-bs-target="#category-{{ $category->id }}" aria-expanded="false" aria-controls="category-{{ $category->id }}" style="cursor: pointer;">
                    {{ $category->name }}
                </div>
                @php
                $child = $category->children;
                @endphp
                @if($child->isNotEmpty())
                <div id="category-{{ $category->id }}" class="collapse" style="padding-left: 15px;">
                    @foreach ($child as $item)
                    <div class="subcategory-item" data-slug="{{ $item->slug }}" style="cursor: pointer;">
                        {{ $item->name }}
                    </div>
                    @endforeach
                </div>
                @endif
                @endif
                @endforeach
            </div>
            <div class="col-lg-9">
                <h2 id="categoryTitle">Our Items</h2>
                <div class="row">
                    <div id="items-container"></div>
                </div>
                <div id="loading">Loading...</div>
            </div>
        </div>

        <button class="btn text-white w-100 d-lg-none mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" style="background-color: #e64343;">
            ☰ Menu
        </button>
    </div>


    <div id="category-container"></div>


    <!-- footer start -->
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
    <!-- footer end -->

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        // $(document).ready(function() {
        //     let page = 1;
        //     let isLoading = false;
        //     let category = '';
        //     let hasMoreData = true; // Track if more data exists

        //     // Scroll event to load more data
        //     $(window).on('scroll', function() {
        //         if (isLoading || !hasMoreData) return; // Prevent further loading if already loading or no data left

        //         if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
        //             page++;
        //             loadCategoriesItem(category, page);
        //         }
        //     });

        //     // Click event on subcategories
        //     $(document).on('click', '.subcategory-item', function() {
        //         page = 1; // Reset pagination when selecting a category
        //         category = $(this).data('slug');
        //         $('#items-container').empty(); // Clear previous items
        //         loadCategoriesItem(category, page);
        //     });

        //     // Function to load items for a category
        //     function loadCategoriesItem(category, page) {
        //         $('#loading').show(); // Show loading spinner

        //         $.ajax({
        //             url: '/menuItems',
        //             type: 'GET',
        //             data: {
        //                 category,
        //                 page
        //             },
        //             success: function(response) {
        //                 if (!response.html.trim()) {
        //                     hasMoreData = false; // No more items to load
        //                     $('#loading').hide();
        //                     return;
        //                 }

        //                 $('#items-container').append(response.html); // Append new items to the container
        //                 isLoading = false;
        //                 $('#loading').hide();
        //             },
        //             error: function() {
        //                 isLoading = false;
        //                 $('#loading').hide();
        //             }
        //         });
        //     }
        // });
        $(document).ready(function() {
    let page = 1;
    let isLoading = false;
    let selectedCategory = '';
    let hasMoreData = true;

    // **Category Click Event (New)**
    $(document).on('click', '.category-link', function() {
        page = 1; // Reset pagination
        selectedCategory = $(this).data('category'); // Get category ID
        $('#items-container').empty(); // Clear previous items
        hasMoreData = true; // Reset hasMoreData
        loadCategoriesItem(selectedCategory, page);
    });

    // **Subcategory Click Event**
    $(document).on('click', '.subcategory-item', function() {
        page = 1;
        selectedCategory = $(this).data('slug'); // Subcategory slug
        $('#items-container').empty();
        hasMoreData = true;
        loadCategoriesItem(selectedCategory, page);
    });

    // **Scroll Event for Pagination**
    $(window).on('scroll', function() {
        if (isLoading || !hasMoreData) return;

        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
            page++;
            loadCategoriesItem(selectedCategory, page);
        }
    });

    // **Function to Load Items**
    function loadCategoriesItem(category, page) {
        $('#loading').show();
        isLoading = true;

        $.ajax({
            url: '/menuItems',
            type: 'GET',
            data: { category, page },
            success: function(response) {
                if (!response.html.trim()) {
                    hasMoreData = false;
                    $('#loading').hide();
                    return;
                }
                $('#items-container').append(response.html);
                isLoading = false;
                $('#loading').hide();
            },
            error: function() {
                isLoading = false;
                $('#loading').hide();
            }
        });
    }
});

    </script>
</body>

</html>