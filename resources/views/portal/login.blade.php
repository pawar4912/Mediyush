@include('portal.common.header')


<!-- Contact Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Login</h1>
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
                @if (session('error'))
                <div class="col-sm-12">
                    <div class="alert alert-danger">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                <form method="POST" action="/login?redirect={{request()->get('redirect')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">
                                <label for="email">Your Email</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="pass" name="password" placeholder="Your Name">
                                <label for="pass">Password</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Login</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="wow fadeInUp" data-wow-delay="0.5s">
                    <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Register here</h1>
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
                    <form method="POST" action="/register" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Your Name" name="firstName">
                                    <label for="name">First Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Your Name" name="lastName">
                                    <label for="name">Last Name</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Your Email" name="email">
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="pass" placeholder="Password" name="password">
                                    <label for="pass">Password</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="cpass" placeholder="Confirm Password" name="cpassword">
                                    <label for="cpass">Confirm Password</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@include('portal.common.footer')
