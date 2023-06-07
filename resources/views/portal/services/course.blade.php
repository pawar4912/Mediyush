@include('portal.common.header')

<!-- Header Start -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
    <div class="container my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Services</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb text-uppercase">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Services</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Courses</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Header End -->

<!-- Category Start -->
<div class="container-xxl py-5">
    @if (session('error'))
    <div class="col-sm-12">
        <div class="alert alert-danger">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Explore Our Courses</h1>
        <div class="row g-4">
            @if($course && count($course) !== 0)
            @foreach ($course as $course)
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <a class="cat-item rounded p-4" href="/course/desc/{{ $course->id }}" style="height: 55%">
                    <div class="d-flex align-items-center">
                        <img class="img-fluid " src="/courses/{{$course->banner}}">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-3 mt-4">{{ $course->name }}</h6>
                        <p>
                          Price:
                            <span class="mb-0 original-price">₹ {{ $course->original_price }}</span>
                            <span class="mb-0 offered-price">₹ {{ $course->price }}</span>
                        </p>
                        <a class="btn btn-primary" href="/course/addtocart/{{ $course->id }}">Add to cart</a>
                    </div>
                </a>
            </div>
            @endforeach
            @else
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <p>Currently no course is available!</p>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- Category End -->

@include('portal.common.footer')
