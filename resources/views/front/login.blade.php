<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Order And Menu</title>
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
    <style>
        	*,
    *:before{
        padding: 4px;
        
    }
    *:after {
        box-sizing: border-box;
        margin: 0;
        padding: 0px;
    }

    body {
        font-family: 'Open Sans', Helvetica, Arial, sans-serif;
        background: #F1F8FF;
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

    .img:before {
        content: '';
        position: absolute;
        right: 0;
        top: 0;
        width: 900px;
        height: 100%;
        background-image: url("ext.jpg");
        opacity: .8;
        background-size: cover;
        -webkit-transition: -webkit-transform 1.2s ease-in-out;
        transition: transform 1.2s ease-in-out;
        transition: transform 1.2s ease-in-out, -webkit-transform 1.2s ease-in-out;
    }


    .img:after {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: #fea116e0;
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
        margin: 25px auto 0;
        text-align: center;
    }

    label span {
        font-size: 12px;
        color: #000000;
        text-transform: uppercase;
    }

    input {
        display: block;
        width: 100%;
        margin-top: -20px;
        padding-bottom: 7px;
        font-size: 16px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.4);
        text-align: center;
    }

    .forgot-pass {
        margin-top: 15px;
        text-align: center;
        font-size: 12px;
        color: #000000;
    }

    .submit {
        margin-top: 40px;
        margin-bottom: 20px;
        background: #fea116;
        text-transform: uppercase;
    }
    .sign-up-btn {
        margin-top: 30px;
    }

    .fb-btn {
        border: 2px solid #fea116;
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
    }
    </style>
</head>

<body>

    <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Order And Menu</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="{{route('home.index') }}" class="nav-item nav-link">Home</a>
                        <a href="{{route('home.about-us') }}" class="nav-item nav-link active">About Us</a>
                        <a href="{{route('home.contact-us') }}" class="nav-item nav-link">Contact Us</a>
                        <a href="{{route('home.services') }}" class="nav-item nav-link">Disclaimer</a>
                        
                        
                    </div>
                    <a href="{{ route('home.login')}}" class="btn btn-primary py-2 px-4">Sign In</a>
                </div>
            </nav>
        </div>
    <!-- Navbar & Hero End -->



<!-- sign in start -->
<br>

<br>
<div class="cont">
    <div class="form sign-in">
        <h2>Welcome Back</h2>
          @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <!-- Login form -->
        <form method="POST" action="{{ route('login') }}">
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
        </form>
    </div>

    <div class="sub-cont">
        <div class="img">
            <div class="img__text m--up">
                <h2>New here?</h2>
                <p>Sign up and discover great experiences!</p>
            </div>
            <div class="img__text m--in">
                <h2>One of us?</h2>
                <p>If you already have an account, sign in to access.</p>
            </div>
            <div class="img__btn">
                <span class="m--up">Sign Up</span>
                <span class="m--in">Sign In</span>
            </div>
        </div>

        <div class="form sign-up">
            <h2>Create your Account</h2>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('message'))  <!-- Add this line -->
                    <div class="alert alert-success">  <!-- Add this line -->
                        {{ session('message') }}  <!-- Add this line -->
                    </div>  <!-- Add this line -->
                @endif  <!-- Add this line -->
            <!-- Registration form -->
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
                <button type="submit" class="submit sign-up-btn">Sign Up</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelector('.img__btn').addEventListener('click', function () {
        document.querySelector('.cont').classList.toggle('s--signup');
    });
</script>
