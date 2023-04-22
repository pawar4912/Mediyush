@include('portal.common.header')

<!-- Header Start -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
  <div class="container my-5 pt-5 pb-4">
      <h1 class="display-3 text-white mb-3 animated slideInDown">My Account</h1>
  </div>
</div>
<!-- Header End -->

<!-- My Profile Start -->
<div class="container-xxl py-5">
  <div class="container">
      <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">My Learnigs</h1>
      <div class="row g-4">
          <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
              <a class="cat-item rounded p-4" href="detail.html">
                  <i class="fa fa-3x fa-mail-bulk text-primary mb-4"></i>
                  <h6 class="mb-3">Masters in Trichology (Long term course)</h6>
              </a>
          </div>
      </div>
  </div>
</div>
<!-- My Profile End -->

@include('portal.common.footer')