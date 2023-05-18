@include('portal.common.header')
<!-- Header Start -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
   <div class="container my-5 pt-5 pb-4">
      <h1 class="display-3 text-white mb-3 animated slideInDown">Course Detail</h1>
   </div>
</div>
<!-- Header End -->

<!-- Job Detail Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
   <div class="container">
   @if (session('error'))
    <div class="col-sm-12">
        <div class="alert alert-danger">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
  @endif
      <div class="row gy-5 gx-4">
         <div class="col-lg-8">
            <div class="d-flex align-items-center mb-5">
               <img class="flex-shrink-0 img-fluid border rounded" src="/courses/{{$details->banner}}" alt="" style="width: 80px; height: 80px;">
               <div class="text-start ps-4">
                  <h3 class="mb-3">{{ $details->name }}</h3>
                  <span class="text-truncate me-3"><i class="fa fa-user text-primary me-2"></i>By {{ $details->auther }}</span>
                  <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{ $details->start_date }} to {{ $details->end_date }}</span>
                  <span class="text-truncate me-3"><i class="far fa-money-bill-alt text-primary me-2"></i>₹ {{ number_format($details->price) }}</span>
                  <span class="text-truncate me-3"><a class="btn btn-primary" href="/course/addtocart/{{ $details->id }}"><i class="fa fa-shopping-cart me-2" aria-hidden="true"></i></a></span>
               </div>
            </div>
            <div class="mb-5">
               <h4 class="mb-3">Course description</h4>
               <p>{{ $details->description }}</p>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Job Detail End -->
@include('portal.common.footer')