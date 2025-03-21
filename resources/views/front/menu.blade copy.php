<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="order.css">
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
        .category-link:hover, .category-link.active {
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
            width: 250px !important; /* Adjust width as needed */
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
        <a class="navbar-brand fw-bold" href="#">
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
                <li class="breadcrumb-item"><a href="#" class="text-danger text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Menu</li>
            </ol>
        </nav>
    </div>
</div>

    <!-- menu start -->
    <div class="container">
        <div class="row py-4">
            
        </div>

        <!-- Burger Icon for Mobile -->
        <button class="btn text-white w-100 d-lg-none mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" style="background-color: #e64343;">
            ☰ Menu
        </button>

        <div class="row">
            <!-- Sidebar Categories (Offcanvas for Mobile) -->
            <div class="col-lg-3">
                <div class="offcanvas-lg offcanvas-start offcanvas-custom" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="sidebarMenuLabel">Categories</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="category-sidebar">
                            <h5 class="mb-4">Product Categories</h5>
                            
                            <!-- All Items -->
                            <div class="category-item">
                                <div class="category-link active" onclick="handleCategoryClick('all')">All</div>
                            </div>
                            
                            <!-- Appetizers -->
                            <div class="category-item">
                                <div class="category-link" onclick="handleCategoryClick('appetizers'); toggleSubcategory('appetizer-sub')">Appetizers</div>
                                <div id="appetizer-sub" class="subcategory-container">
                                    <div class="subcategory-item" onclick="handleSubcategoryClick('appetizers', 'hot')">Hot Appetizers</div>
                                    <div class="subcategory-item" onclick="handleSubcategoryClick('appetizers', 'cold')">Cold Appetizers</div>
                                    <div class="subcategory-item" onclick="handleSubcategoryClick('appetizers', 'sharing')">Sharing Platters</div>
                                </div>
                            </div>
                            
                            <!-- Salads -->
                            <div class="category-item">
                                <div class="category-link" onclick="handleCategoryClick('salads'); toggleSubcategory('salad-sub')">Salads</div>
                                <div id="salad-sub" class="subcategory-container">
                                    <div class="subcategory-item" onclick="handleSubcategoryClick('salads', 'green')">Green Salads</div>
                                    <div class="subcategory-item" onclick="handleSubcategoryClick('salads', 'fruit')">Fruit Salads</div>
                                    <div class="subcategory-item" onclick="handleSubcategoryClick('salads', 'protein')">Protein Salads</div>
                                </div>
                            </div>
                            
                            <!-- Entrees -->
                            <div class="category-item">
                                <div class="category-link" onclick="handleCategoryClick('entrees'); toggleSubcategory('entree-sub')">Entrees</div>
                                <div id="entree-sub" class="subcategory-container">
                                    <div class="subcategory-item" onclick="handleSubcategoryClick('entrees', 'pasta')">Pasta Dishes</div>
                                    <div class="subcategory-item" onclick="handleSubcategoryClick('entrees', 'meat')">Meat Dishes</div>
                                    <div class="subcategory-item" onclick="handleSubcategoryClick('entrees', 'seafood')">Seafood Dishes</div>
                                </div>
                            </div>
                            
                            <!-- Sides -->
                            <div class="category-item">
                                <div class="category-link" onclick="handleCategoryClick('sides'); toggleSubcategory('side-sub')">Sides</div>
                                <div id="side-sub" class="subcategory-container">
                                    <div class="subcategory-item" onclick="handleSubcategoryClick('sides', 'potatoes')">Potato Sides</div>
                                    <div class="subcategory-item" onclick="handleSubcategoryClick('sides', 'vegetables')">Vegetable Sides</div>
                                    <div class="subcategory-item" onclick="handleSubcategoryClick('sides', 'grains')">Grain Sides</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-lg-9">
                <h2 id="categoryTitle">All Items</h2>
                
                <!-- Menu Items Container -->
                <div class="row" id="menuContainer">
                    <!-- Default "All" content will be loaded here -->
                </div>
            </div>
        </div>
    </div>


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
      
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Menu items data
        const menuItems = {
            appetizers: [
                {
                    name: "Mozzarella Sticks",
                    image: "img/blog1.png",
                    price: "$8.99",
                    rating: 4.5,
                    subcategory: "hot"
                },
                {
                    name: "Mozzarella Sticks",
                    image: "img/blog1.png",
                    price: "$8.99",
                    rating: 4.5,
                    subcategory: "hot"
                },
                {
                    name: "Mozzarella Sticks",
                    image: "img/blog1.png",
                    price: "$8.99",
                    rating: 4.5,
                    subcategory: "hot"
                },
                {
                    name: "Garlic Bread",
                    image: "img/blig2.png",
                    price: "$5.99",
                    rating: 4.2,
                    subcategory: "hot"
                },
                {
                    name: "Bruschetta",
                    image: "img/blog1.png",
                    price: "$7.99",
                    rating: 4.7,
                    subcategory: "cold"
                },
                {
                    name: "Antipasto Platter",
                    image: "img/blig2.png",
                    price: "$14.99",
                    rating: 4.8,
                    subcategory: "sharing"
                }
            ],
            salads: [
                {
                    name: "Caesar Salad",
                    image: "img/blig2.png",
                    price: "$10.99",
                    rating: 4.3,
                    subcategory: "green"
                },
                {
                    name: "Greek Salad",
                    image: "img/blog1.png",
                    price: "$11.99",
                    rating: 4.6,
                    subcategory: "green"
                },
                {
                    name: "Fruit Medley",
                    image: "img/blog1.png",
                    price: "$9.99",
                    rating: 4.1,
                    subcategory: "fruit"
                },
                {
                    name: "Chicken Salad",
                    image: "img/blig2.png",
                    price: "$12.99",
                    rating: 4.4,
                    subcategory: "protein"
                }
            ],
            entrees: [
                {
                    name: "Spaghetti Bolognese",
                    image: "img/blog1.png",
                    price: "$15.99",
                    rating: 4.9,
                    subcategory: "pasta"
                },
                {
                    name: "Chicken Parmesan",
                    image: "img/blig2.png",
                    price: "$17.99",
                    rating: 4.8,
                    subcategory: "meat"
                },
                {
                    name: "Grilled Salmon",
                    image: "img/blog1.png",
                    price: "$19.99",
                    rating: 4.7,
                    subcategory: "seafood"
                },
                {
                    name: "Beef Wellington",
                    image: "img/blig2.png",
                    price: "$24.99",
                    rating: 4.9,
                    subcategory: "meat"
                }
            ],
            sides: [
                {
                    name: "French Fries",
                    image: "img/blog1.png",
                    price: "$4.99",
                    rating: 4.2,
                    subcategory: "potatoes"
                },
                {
                    name: "Mashed Potatoes",
                    image: "img/blig2.png",
                    price: "$5.99",
                    rating: 4.4,
                    subcategory: "potatoes"
                },
                {
                    name: "Steamed Vegetables",
                    image: "img/blog1.png",
                    price: "$5.99",
                    rating: 4.0,
                    subcategory: "vegetables"
                },
                {
                    name: "Rice Pilaf",
                    image: "img/blig2.png",
                    price: "$4.99",
                    rating: 4.3,
                    subcategory: "grains"
                }
            ]
        };
        
        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Load "All" content by default
            displayMenuItems('all');
        });
        
        // Handle category click
        function handleCategoryClick(category) {
            showCategory(category);
            closeSidebarOnMobile();
        }
        
        // Handle subcategory click
        function handleSubcategoryClick(category, subcategory) {
            showSubcategory(category, subcategory);
            closeSidebarOnMobile();
        }
        
        // Close sidebar on mobile
        function closeSidebarOnMobile() {
            if (window.innerWidth < 992) { // Bootstrap's lg breakpoint
                const offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('sidebarMenu'));
                offcanvas.hide();
            }
        }
        
        // Show category items
        function showCategory(category) {
            // Update title
            document.getElementById('categoryTitle').innerText = 
                category === 'all' ? 'All Items' : 
                category.charAt(0).toUpperCase() + category.slice(1);
            
            // Update active category
            document.querySelectorAll('.category-link').forEach(link => {
                link.classList.remove('active');
            });
            event.currentTarget.classList.add('active');
            
            // Display items
            displayMenuItems(category);
        }
        
        // Show subcategory items
        function showSubcategory(category, subcategory) {
            // Update title based on subcategory
            const titles = {
                'hot': 'Hot Appetizers',
                'cold': 'Cold Appetizers',
                'sharing': 'Sharing Platters',
                'green': 'Green Salads',
                'fruit': 'Fruit Salads',
                'protein': 'Protein Salads',
                'pasta': 'Pasta Dishes',
                'meat': 'Meat Dishes',
                'seafood': 'Seafood Dishes',
                'potatoes': 'Potato Sides',
                'vegetables': 'Vegetable Sides',
                'grains': 'Grain Sides'
            };
            
            document.getElementById('categoryTitle').innerText = titles[subcategory];
            
            // Display filtered items
            displayMenuItems(category, subcategory);
        }
        
        // Toggle subcategory visibility
        function toggleSubcategory(id) {
            // Hide all subcategory containers
            document.querySelectorAll('.subcategory-container').forEach(container => {
                container.style.display = 'none';
            });
            
            // Show the selected subcategory
            const subContainer = document.getElementById(id);
            subContainer.style.display = 'block';
        }
        
        // Display menu items
        function displayMenuItems(category, subcategory = null) {
            const menuContainer = document.getElementById('menuContainer');
            menuContainer.innerHTML = '';
            
            let items = [];
            
            if (category === 'all') {
                // Combine all items for "All" category
                Object.values(menuItems).forEach(categoryItems => {
                    items = [...items, ...categoryItems];
                });
            } else if (subcategory) {
                // Filter by subcategory if provided
                items = menuItems[category].filter(item => item.subcategory === subcategory);
            } else {
                // Show all items in the category
                items = menuItems[category];
            }
            
            // Display items
            items.forEach(item => {
                // Create star rating
                let stars = '';
                for (let i = 1; i <= 5; i++) {
                    stars += i <= Math.floor(item.rating) ? '<i class="stars">★</i>' : '<i class="stars">☆</i>';
                }
                
                const menuItemHtml = `
                    <div class="col-md-4">
                        <div class="card menu-item">
                            <img src="${item.image}" class="card-img-top menu-image" alt="${item.name}">
                            <div class="card-body">
                                <h5 class="card-title">${item.name}</h5>
                                <div class="mb-2">${stars}</div>
                                <p class="card-text">Price: ${item.price}</p>
                            </div>
                        </div>
                    </div>
                `;
                menuContainer.innerHTML += menuItemHtml;
            });
        }
    </script>
</body>
</html>