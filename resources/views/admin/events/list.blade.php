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
                        <a href="/admin/events/add" class="btn btn-outline-primary float-right"> Add Events </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Job Lists</h5>
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
                                @foreach ($events as $event)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $event->name }}</td>
                                    <td>{{ $event->venue }}</td>
                                    <td>{{ $event->description }}</td>
                                    <td>{{ $event->price }}</td>
                                    <td><img src="/events/{{$event->image}}" heigth="100" width="100" alt="tag"></td>
                                    <td>
                                        <?php if(!$event->status){ ?>

                                        <a href="/admin/events/activate/{{ $event->id }}" class="btn btn-success">Activate</a>

                                        <?php }else{ ?>

                                        <a href="/admin/events/deactivate/{{ $event->id }}" class="btn btn-danger">Deactivate</a>

                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="/admin/events/edit/{{ $event->id }}" class="btn btn-secondary">
                                            <i class="ri-edit-2-line"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $events->links() }}
                    </div>
                </div>
            </main>
            @include('admin.common.footer')
        </div>
    </div>
</body>

</html>
