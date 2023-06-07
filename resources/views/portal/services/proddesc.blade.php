@include('portal.common.header')
<!-- Header Start -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
    <div class="container my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Product Detail</h1>
    </div>
</div>
<!-- Header End -->

<!-- Job Detail Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row gy-5 gx-4">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-5">
                    <img class="flex-shrink-0 img-fluid border rounded" src="/products/{{ $product->image }}" alt="" style="width: 80px; height: 80px;">
                    <div class="text-start ps-4">
                        <h3 class="mb-3">{{ $product->name }}</h3>
                        <div class="d-flex">
                            <span class="text-truncate me-3">
                                <div class="d-flex">
                                    <i class="far fa-money-bill-alt text-primary me-2"></i>
                                    <span class="mb-0 original-price">₹ {{ $product->original_price }}</span>
                                    <span class="mb-0 offered-price">₹ {{ $product->price }}</span>
                                </div>
                            </span>
                            <a class="btn btn-primary" href="/product/addtocart/{{ $product->id }}"><i class="fa fa-shopping-cart me-2" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <h4 class="mb-3">Product description</h4>
                    <p>{{ $product->description }}</p>
                </div>
                <div class="">
                    <h6 class="mb-4">For more information. <a href="/contact">Please contact Us.</a></h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Job Detail End -->
@include('portal.common.footer')
