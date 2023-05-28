@include('portal.common.header')
<!-- Header Start -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
   <div class="container my-5 pt-5 pb-4">
      <h1 class="display-3 text-white mb-3 animated slideInDown">News Detail</h1>
   </div>
</div>
<!-- Header End -->

<!-- Job Detail Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
   <div class="container">
      <div class="row gy-5 gx-4">
         <div class="col-lg-8">
            <div class="d-flex align-items-center mb-5">
               <img class="flex-shrink-0 img-fluid border rounded" src="/news/{{$news->image}}" alt="" style="width: 80px; height: 80px;">
               <div class="text-start ps-4">
                  <h3 class="mb-3">{{ $news->title }}</h3>
               </div>
            </div>
            <div class="mb-5">
               <h4 class="mb-3">News description</h4>
               <p>{{ $news->description }}</p>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Job Detail End -->
@include('portal.common.footer')