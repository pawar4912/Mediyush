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
                    <h1 class="card-title">News Lists</h1>
                    <div class="add-btn p-2">
                        <a href="/admin/news/add" class="btn btn-outline-primary float-right"> Add News </a>
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
                            <th>Tital</th>
                            <th>Image</th>
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
            , ajax: "{{ route('admin.news.list') }}"
            , columns: [{
                    data: 'id'
                    , name: 'id'
                }
                , {
                    data: 'title'
                    , name: 'title'
                }
                , {
                    data: 'image'
                    , name: 'image'
                    , orderable: false
                    , searchable: false
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
