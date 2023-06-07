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
                        <a href="/admin/courses/add" class="btn btn-outline-primary float-right"> Add Courses </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Courses Lists</h5>
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
                                    <th scope="col">Name</th>
                                    <th scope="col">Auther</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Banner</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->auther }}</td>
                                    <td>{{ $course->price }}</td>
                                    <td>{{ $course->start_date }}</td>
                                    <td>{{ $course->end_date }}</td>
                                    <td>{{ $course->description }}</td>
                                    <td><img src="/courses/{{$course->banner}}" heigth="100" width="100" alt="tag"></td>
                                    <td>
                                        <a href="/admin/courses/edit/{{ $course->id }}" class="btn btn-success">
                                            <i class="ri-edit-2-line"></i>
                                        </a>
                                        <a href="/admin/courses/delete/{{ $course->id }}" class="btn btn-danger">
                                            <i class="ri-delete-bin-4-line"></i>
                                        </a>
                                        <a href="/admin/courses/applications/{{ $course->id }}" class="btn btn-primary">
                                            <i class="ri-eye-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $courses->links() }}
                    </div>
                </div>
            </main>
            @include('admin.common.footer')
        </div>
    </div>
</body>

</html>
