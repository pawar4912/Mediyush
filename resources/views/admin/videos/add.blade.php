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
                        <h5 class="card-title">Add Video</h5>

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
                        <form class="row g-3" method="post" action="/admin/videos/add" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <label class="form-label">Link</label>
                                <input type="text" class="form-control" id="link" name="link">
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
