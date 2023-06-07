@include('portal.common.header')

<!-- Header Start -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
    <div class="container my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Products</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb text-uppercase">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Products</li>
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
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Explore Our Products</h1>
        <div class="row g-4">
            @if($products && count($products) !== 0)
            @foreach ($products as $product)
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <a class="cat-item rounded p-4" href="/product/desc/{{ $product->id }}" style="height: 55%">
                    <div class="d-flex align-items-center">
                        <img class="img-fluid " src="/products/{{$product->image}}">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-3 mt-4">{{ $product->name }}</h6>
                        <div class="d-flex">
                            <span class="mb-0 original-price">₹ {{ $product->original_price }}</span>
                            <span class="mb-0">₹ {{ $product->price }}</span>
                        </div>
                        <a class="btn btn-primary" href="/product/addtocart/{{ $product->id }}">Add to cart</a>
                    </div>
                </a>
            </div>
            @endforeach
            @else
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <p>Currently no product is available!</p>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- Category End -->

@include('portal.common.footer')
