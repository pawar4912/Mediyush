<!DOCTYPE html>
<html lang="en">
@include('admin.common.head')

<body>
    <div class="container-scroller">
        @include('admin.common.header')

        <div class="container-fluid page-body-wrapper">

            @include('admin.common.sidebar')
            <main id="main" class="main">
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
                            <th>Message</th>
                            <th>User Name</th>
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
            , ajax: "{{ route('admin.feedbacks.list') }}"
            , columns: [{
                    data: 'id'
                    , name: 'id'
                }
                , {
                    data: 'message'
                    , name: 'message'
                }
                , {
                    data: 'user_name'
                    , name: 'user_name'
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
