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
                    <h1 class="card-title">Job Lists</h1>
                    <div class="add-btn p-2">
                        <a href="/admin/jobs/add" class="btn btn-outline-primary float-right"> Add Jobs </a>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company Name</th>
                            <th>Phone Number</th>
                            <th>Company Website</th>
                            <th class="none">Status</th>
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
            , ajax: "{{ route('admin.jobs.list') }}"
            , columns: [{
                    data: 'id'
                    , name: 'id'
                }
                , {
                    data: 'name'
                    , name: 'name'
                }
                , {
                    data: 'email'
                    , name: 'email'
                }
                , {
                    data: 'company_name'
                    , name: 'company_name'
                }
                , {
                    data: 'phone_number'
                    , name: 'phone_number'
                }
                , {
                    data: 'company_website'
                    , name: 'company_website'
                }
                , {
                    data: 'status_change'
                    , name: 'status_change'
                    , orderable: false
                    , searchable: false
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
