<!DOCTYPE html>
<html lang="en">
@include('admin.common.head')

<body>
    <div class="container-scroller">
        @include('admin.common.header')

        <div class="container-fluid page-body-wrapper">

            @include('admin.common.sidebar')
            <main id="main" class="main">
                <div class="card">
                    <div class="p-2">
                        <a href="/admin/gallary/add" class="btn btn-outline-primary float-right"> Add Gallary Photos </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Gallary Photos Lists</h5>
                        @if (session('success'))
                        <div class="col-sm-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Photos</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gallaryPhotos as $gallaryPhoto)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="/gallary_photos/{{ $gallaryPhoto->photos }}" heigth="150" width="150" alt="tag"></td>
                                    <td>{{ $gallaryPhoto->position }}</td>
                                    <td>
                                        <a href="/admin/gallary/edit/{{ $gallaryPhoto->id }}" class="btn btn-success">
                                            <i class="ri-edit-2-line"></i>
                                        </a>
                                        <a href="/admin/gallary/delete/{{ $gallaryPhoto->id }}" class="btn btn-danger">
                                            <i class="ri-delete-bin-4-line"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $gallaryPhotos->links() }}
                    </div>
                </div>
            </main>
            @include('admin.common.footer')
        </div>
    </div>
</body>

</html>
