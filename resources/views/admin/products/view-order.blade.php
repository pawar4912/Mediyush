<!DOCTYPE html>
<html lang="en">
@include('admin.common.head')

<body>
    <div class="container-scroller">
        @include('admin.common.header')

        <div class="container-fluid page-body-wrapper">

            @include('admin.common.sidebar')
            <main id="main" class="main">

                <div class="d-flex pagetitle">
                    <h1 class="card-title">Order</h1>
                    <div class="add-btn p-2">
                        <a href="/admin/products/orders/complete/{{$id}}" class="btn btn-outline-primary float-right"> Complete Order</a>
                    </div>
                </div>
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
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Pirchesed Price</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </main>
            @include('admin.common.footer')
        </div>
    </div>
</body>
<script type="text/javascript">
    $(function() {
        $('.table').DataTable({
            processing: true
            , responsive: true
            , serverSide: true
            , ajax: "{{ route('admin.products.orders.view', $id) }}"
            , columns: [{
                    data: 'id'
                    , name: 'id'
                }
                , {
                    data: 'name'
                    , name: 'name'
                }
                , {
                    data: 'product_price'
                    , name: 'product_price'
                }
                , {
                    data: 'image'
                    , name: 'image'
                    , orderable: false
                    , searchable: false
                }
            , ]
        , });

    });

</script>
</html>
