@include('portal.common.header')

<!-- Header End -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
    <div class="container my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Job List</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb text-uppercase">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Job</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Job List</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Header End -->

<!-- Jobs Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="lable-head">
            <h1 class="mb-5 wow fadeInUp" data-wow-delay="0.1s">Job Listing</h1>
            <a class="mb-5 wow fadeInUp lable-btn" data-wow-delay="0.1s" href="/post/job">Post Job<i class="fa fa-arrow-right ms-2"></i></a>
        </div>
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
                    @if (session('error'))
                        <div class="col-sm-12">
                            <div class="alert alert-danger">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @foreach($jobs as $job)
                        <div class="job-item p-4 mb-4" >
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <!-- <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-1.jpg" alt="" style="width: 80px; height: 80px;"> -->
                                    <div class="text-start ps-4">
                                        <h5 class="mb-3">{{ $job->name }}</h5>
                                        <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $job->company_name }}</span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{ $job->experience }}</span>
                                        <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>₹{{ $job->salary }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <a class="btn btn-primary" href="/job/applyjob/{{ $job->id }}">Apply Now</a>
                                    </div>
                                    <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: {{ $job->created_at }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Jobs End -->

@include('portal.common.footer')