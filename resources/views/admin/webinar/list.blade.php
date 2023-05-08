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
                        <a href="/admin/webinar/add" class="btn btn-outline-primary float-right"> Add Webinar </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Webinar Lists</h5>
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
                                    <th scope="col">Venue</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($webinar as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->venue }}</td>
                                    <td>{{ $data->description }}</td>
                                    <td>{{ $data->price }}</td>
                                    <td><img src="/webinar/{{$data->image}}" heigth="100" width="100" alt="tag"></td>
                                    <td>
                                        <?php if(!$data->status){ ?>

                                        <a href="/admin/webinar/activate/{{ $data->id }}" class="btn btn-success">Activate</a>

                                        <?php }else{ ?>

                                        <a href="/admin/webinar/deactivate/{{ $data->id }}" class="btn btn-danger">Deactivate</a>

                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="/admin/webinar/edit/{{ $data->id }}" class="btn btn-secondary">
                                            <i class="ri-edit-2-line"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $webinar->links() }}
                    </div>
                </div>
            </main>
            @include('admin.common.footer')
        </div>
    </div>
</body>

</html>
