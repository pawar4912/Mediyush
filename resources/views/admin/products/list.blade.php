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
                        <a href="/admin/products/add" class="btn btn-outline-primary float-right"> Add Shop Products </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Shop Products Lists</h5>
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
                                    <th scope="col">Original Price</th>
                                    <th scope="col">Offered Price</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->original_price }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td><img src="/products/{{ $product->image }}" heigth="150" width="150" alt="tag"></td>
                                    <td>{{ $product->description }}</td>
                                    <td>
                                        <a href="/admin/products/edit/{{ $product->id }}" class="btn btn-success">
                                            <i class="ri-edit-2-line"></i>
                                        </a>
                                        <a href="/admin/products/delete/{{ $product->id }}" class="btn btn-danger">
                                            <i class="ri-delete-bin-4-line"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </main>
            @include('admin.common.footer')
        </div>
    </div>
</body>

</html>
