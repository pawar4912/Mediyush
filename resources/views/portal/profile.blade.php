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
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">My Account</h1>
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
            <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                        <h6 class="mt-n1 mb-0">Profile</h6>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
                        <h6 class="mt-n1 mb-0">My Learnings</h6>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
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
                    <div class="job-item p-4 mb-4">
                        <form method="POST" action="/updateProfile" enctype="multipart/form-data">
                        @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="Your Name" name="firstName" value="{{ $user->first_name }}">
                                        <label for="name">First Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="Your Name" name="lastName" value="{{ $user->last_name }}">
                                        <label for="name">Last Name</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="Your Email" name="email" value="{{ $user->email }}" readonly>
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="experiance" placeholder="Experience" name="experience" value="{{ $user->experience }}">
                                        <label for="experiance">Experience in months</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="skills" placeholder="skills" name="skills" value="{{ $user->skills }}">
                                        <label for="skills">Skills</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <select class="form-select" aria-label="Highest Qualification" name="qualification">
                                            <option>Select Highest Qualification</option>
                                            @if(isset($user->qualification))
                                            <option selected value="{{ $user->qualification }}">{{ $user->qualification }}</option>
                                            @endif
                                            <option value="S.S.C">S.S.C</option>
                                            <option value="H.S.C">H.S.C</option>
                                            <option value="B.E">BE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="file" class="form-control" id="resume" placeholder="resume" name="cv">
                                        <label for="resume">Upload CV</label>
                                        @if(isset($user->cv))
                                        <a href="{{ $user->cv }}" target="_blank">Download CV</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="tab-2" class="tab-pane fade show p-0">
                @if($details && count($details) !== 0)
                    @foreach($details as $detail)
                    <div class="job-item p-4 mb-4">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid border rounded" src="/courses/{{$detail->banner}}" alt="" style="width: 80px; height: 80px;">
                                <div class="text-start ps-4">
                                    <h5 class="mb-3">{{ $detail->name }}</h5>
                                    <span class="text-truncate me-3"><i class="fa fa-user text-primary me-2"></i>By {{ $detail->auther }}</span>
                                    <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{ $detail->start_date }} to {{ $detail->end_date }}</span>
                                    <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>₹ {{ number_format($detail->price) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <p>You don't have order Yet!</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- My Profile End -->

@include('portal.common.footer')