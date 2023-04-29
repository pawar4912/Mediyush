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
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                @if($carts && count($carts) !== 0)
                @foreach($carts as $cart)
                    <div class="job-item p-4 mb-4" >
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid border rounded" src="/courses/{{$cart->banner}}" alt="" style="width: 80px; height: 80px;">
                                <div class="text-start ps-4">
                                    <h5 class="mb-3">{{ $cart->name }}</h5>
                                    <span class="text-truncate me-3"><i class="fa fa-user text-primary me-2"></i>By {{ $cart->auther }}</span>
                                    <span class="text-truncate me-3"><i class="fa fa-circle text-primary me-2"></i>Full Time</span>
                                    <span class="text-truncate me-0"><i class="far fa-calendar-alt text-primary me-2"></i>{{ $cart->start_date }} To {{ $cart->end_date }}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                <div class="d-flex mb-3">
                                    <a href="/cart/deletecart/{{ $cart->id }}"><i class="fa fa-trash text-danger me-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p>Your cart is empty!</p>
                </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Jobs End -->

@include('portal.common.footer')