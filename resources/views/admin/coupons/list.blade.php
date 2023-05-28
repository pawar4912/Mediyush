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
                    <h1 class="card-title">Coupons Lists</h1>
                    <div class="add-btn p-2">
                        <a href="/admin/coupons/add" class="btn btn-outline-primary float-right"> Add Coupons </a>
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
                            <th>Code</th>
                            <th>Type</th>
                            <th>Minimum Price Required To Apply Coupons</th>
                            <th>Description</th>
                            <th class="none">Action</th>
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
            , ajax: "{{ route('admin.coupons.list') }}"
            , columns: [{
                    data: 'id'
                    , name: 'id'
                }
                , {
                    data: 'code'
                    , name: 'code'
                }
                , {
                    data: 'type'
                    , name: 'type'
                }
                , {
                    data: 'minimum_amount_required'
                    , name: 'minimum_amount_required'
                }
                , {
                    data: 'description'
                    , name: 'description'
                }
                , {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: false
                }
            , ]
        , });

    });

</script>
</html>
