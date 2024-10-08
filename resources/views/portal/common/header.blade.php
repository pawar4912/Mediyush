<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Mediyush</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('assets/portal/img/logo.jpeg')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/portal/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/portal/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/portal/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/portal/css/style.css')}}" rel="stylesheet">

    <!-- custom Stylesheet -->
    <link href="{{ asset('assets/portal/css/main.css')}}" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="/" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <img class="img-fluid" src="{{ asset('assets/portal/img/logo.jpeg')}}" alt="" style="width: 50%">
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="/home" class="nav-item nav-link active">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Service</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="/service/course" class="dropdown-item">Course</a>
                            <a href="/service/events" class="dropdown-item">Events</a>
                            {{-- <a href="/service/webinar" class="dropdown-item">Webinar</a>
                            <a href="/service/blog" class="dropdown-item">Blog</a> --}}
                            <a href="/service/news" class="dropdown-item">News</a>
                        </div>
                    </div>
                    <a href="/job" class="nav-item nav-link">Jobs</a>
                    <a href="/about" class="nav-item nav-link">About</a>
                    <a href="/contact" class="nav-item nav-link">Contact</a>
                    @if(Auth::guard('user')->user())
                    <a href="/cart" class="nav-item nav-link"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                    <a href="/logout" class="nav-item nav-link"><i class="fas fa-sign-out-alt" aria-hidden="true"></i></a>
                    @endif
                </div>

                @if(Auth::guard('user')->user())
                  <a href="/myaccount" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">My Account<i class="fa fa-arrow-right ms-3"></i></a>
                @else
                <a href="/login" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Login<i class="fa fa-arrow-right ms-3"></i></a>
                @endif

            </div>
        </nav>
        <!-- Navbar End -->