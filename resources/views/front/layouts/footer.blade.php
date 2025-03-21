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
