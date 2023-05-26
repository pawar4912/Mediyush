@include('portal.common.header')
<!-- Header End -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
    <div class="container my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Cart listing</h1>
    </div>
</div>
<!-- Header End -->
<!-- Jobs Start -->
<div class="container-xxl py-5">
    <div class="container">
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session('success'))
        <div class="col-sm-12">
            <div class="alert alert-success">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif
        <div class="row g-4">
            <div class="col">
                <div class="container">
                    @php
                    $total = 0;
                    @endphp
                    @if(count($cartCources) !== 0 || count($cartProducts) !== 0)
                    @foreach($cartCources as $cartCource)
                    <div class="row">
                        <div class="col-8 d-flex align-items-center">
                            <img class="flex-shrink-0 img-fluid border rounded" src="/courses/{{$cartCource->banner}}" alt="" style="width: 80px; height: 80px;">
                            <div class="text-start ps-4">
                                <h5 class="mb-3">{{ $cartCource->name }}</h5>
                                <span class="text-truncate me-3"><i class="fa fa-user text-primary me-2"></i>By {{ $cartCource->auther }}</span>
                                <span class="text-truncate me-0"><i class="far fa-calendar-alt text-primary me-2"></i>{{ $cartCource->start_date }} To {{ $cartCource->end_date }}</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="d-flex mb-3">
                                <a href="/cart/deletecart/{{ $cartCource->cart_id }}"><i class="fa fa-trash text-danger me-2"></i></a>
                            </div>
                            <div class="d-flex mb-3">
                                <p>₹ {{ $cartCource->price }}</p>
                            </div>
                        </div>
                    </div>
                    @php
                    $total += $cartCource->price;
                    @endphp
                    @endforeach
                    @foreach($cartProducts as $cartProduct)
                    <div class="row">
                        <div class="col-8 d-flex align-items-center">
                            <img class="flex-shrink-0 img-fluid border rounded" src="products/{{$cartProduct->image}}" alt="" style="width: 80px; height: 80px;">
                            <div class="text-start ps-4">
                                <h5 class="mb-3">{{ $cartProduct->name }}</h5>
                                <p>{{ $cartProduct->description }}</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="d-flex mb-3">
                                <a href="/cart/deletecart/{{ $cartProduct->cart_id }}"><i class="fa fa-trash text-danger me-2"></i></a>
                            </div>
                            <div class="d-flex mb-3">
                                <p>₹ {{ $cartProduct->price }}</p>
                            </div>
                        </div>
                    </div>
                    @php
                    $total += $cartProduct->price;
                    @endphp
                    @endforeach
                    @else
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <p>Your cart is empty!</p>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <h5 class="card-header card text-white bg-primary mb-3">Cart Summery</h5>
                    <div class="card-body d-flex justify-content-between">
                        <h6 class="mb-3">Total Amount To Pay: </h6>
                        <p class="card-text">₹ {{ number_format($total) }}</p>
                    </div>
                    <div class="d-flex align-items-center">
                        @if($total > 0)
                        <form action="/razorpay-payment" method="POST">
                            @csrf
                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_KEY') }}" data-amount="{{ $total * 100 }}" data-buttontext="Place Order" data-description="Razorpay payment" data-theme.color="#00B074">
                            </script>
                            <!-- <a href="#" class="btn btn-primary text-white">Place Order</a> -->
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Jobs End -->
@include('portal.common.footer')
