@include('portal.common.header')

<!-- Header Start -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
  <div class="container my-5 pt-5 pb-4">
      <h1 class="display-3 text-white mb-3 animated slideInDown">Services</h1>
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb text-uppercase">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Services</a></li>
              <li class="breadcrumb-item text-white active" aria-current="page">News</li>
          </ol>
      </nav>
  </div>
</div>
<!-- Header End -->

<!-- Category Start -->
<div class="container-xxl py-5">
  <div class="container">
      <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">News</h1>
      <div class="row g-4">
      @if($news && count($news) !== 0)
      @foreach ($news as $n)
				<div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
						<a class="cat-item rounded p-4" href="/news/desc/{{ $n->id }}">
							<div class="d-flex align-items-center">
								<img class="img-fluid flex-shrink-0 rounded" src="/news/{{$n->image}}">
              </div>
							<h6 class="mb-3 mt-4">{{ $n->title }}</h6>
						</a>
				</div>
			@endforeach
      @else
			<div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
					<p>Currently no news available!</p>
			</div>
			@endif
      </div>
  </div>
</div>
<!-- Category End -->

@include('portal.common.footer')