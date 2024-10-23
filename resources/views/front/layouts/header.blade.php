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
                        <a href="{{ route('home.index')}}" class="nav-item nav-link active">Home</a>
                        <a href="{{ route('home.about-us')}}" class="nav-item nav-link">About Us</a>
                        <!-- <a href="service.html" class="nav-item nav-link">Contact Us</a> -->
                        <a href="{{ route('home.contact-us')}}" class="nav-item nav-link">Contact Us</a>
                        <a href="{{ route('home.services')}}" class="nav-item nav-link">Disclaimer</a>
                        
                    </div>
                    <a href="{{ route('home.login') }}" class="btn btn-primary py-2 px-4">Sign In</a>
                    
                </div>
            </nav>

            <div class="py-5 bg-dark hero-header mb-5">
                <div class="container my-5 py-5">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-6 text-center text-lg-start">
                            <h1 class="display-3 text-white animated slideInLeft">Order and Menu<br>elevate Your Dining Experience</h1>
                            <p class="text-white animated slideInLeft mb-4 pb-2">Order and Menu, transform your dining experience by crafting unique, delicious menus that showcase your restaurant's style and flavor.

                                Contact Us</p>
                            <a href="{{ route('home.contact-us') }}" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Contact Us</a>
                        </div>
                        <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                            <img class="img-fluid" src="{{ asset('front-assets/img/hero.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>