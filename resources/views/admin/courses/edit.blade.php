<!DOCTYPE html>
<html lang="en">
@include('admin.common.head')

<body>
    <div class="container-scroller">
        @include('admin.common.header')

        <div class="container-fluid page-body-wrapper">

            @include('admin.common.sidebar')
            <main id="main" class="main">
                <div class="card col-md-7">
                    <div class="card-body">
                        <h5 class="card-title">Edit Gallary Photo</h5>

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
                        <form class="row g-3" method="post" action="/admin/courses/edit/{{ $course->id }}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $course->name }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Auther</label>
                                <input type="text" class="form-control" id="auther" name="auther" value="{{ $course->auther }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Original Price</label>
                                <input type="text" class="form-control" id="original_price" name="original_price" value="{{ $course->original_price }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Offered Price</label>
                                <input type="number" class="form-control" id="price" name="price" value="{{ $course->price }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Banner</label>
                                <input type="file" class="form-control" id="banner" name="banner">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $course->start_date }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $course->end_date }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description">{{ $course->description }}</textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>
            </main>
        </div>
        @include('admin.common.footer')
    </div>
</body>

</html>
