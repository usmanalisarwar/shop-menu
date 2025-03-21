@extends('front.layouts.app')

@section('content')
    <!-- About Start -->
    <div class="py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s" src="{{ asset('front-assets/img/resturent 5.jpg') }}">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.3s" src="{{ asset('front-assets/img/resturent 6.jpg') }}" style="margin-top: 25%;">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.5s" src="{{ asset('front-assets/img/resturent 9 (1).jpg') }}">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.7s" src="{{ asset('front-assets/img/resturent 10.jpg') }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h5 class="section-title ff-secondary text-start text-primary fw-normal">About Us</h5>
                    <h1 class="mb-4">Welcome to <i class="fa fa-utensils text-primary me-2"></i>Order and <br>Menu</h1>
                    <p class="mb-4">Order and Menu – where our mission is to simplify restaurant menu creation. We specialize in delivering customized menus that enhance your customers' dining experience.</p>
                    <p class="mb-4">Whether you're looking to revamp an existing menu or create something new, our expert team is here to provide you with professional, stylish, and functional menus tailored to your needs. Get started with us today and elevate your restaurant's presentation!</p>

                    <a class="btn btn-primary py-3 px-5 mt-2" href="{{ route('home.about-us')}}">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

@endsection
