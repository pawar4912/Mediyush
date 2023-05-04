<!DOCTYPE html>
<html lang="en">
@include('admin.common.head')

<body>
    <div class="container-scroller">
        @include('admin.common.header')

        <div class="container-fluid page-body-wrapper">

            @include('admin.common.sidebar')
            <main id="main" class="main">

                <div class="card col-md-12">
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
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Company Name</th>
                                    <th>Phone Number</th>
                                    <th>Company Website</th>
                                    <th>Salary</th>
                                    <th>Experience</th>
                                    <th>Description</th>
                                    <th class="none">Status</th>
                                    <th class="none">Action</th>
                                    <th class="all"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </main>
            @include('admin.common.footer')
        </div>
    </div>
</body>
<script type="text/javascript">
    $(function() {
        $('.table').DataTable({
            processing: true
            ,responsive: true,
            serverSide: true
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
                    data: 'salary'
                    , name: 'salary'
                }
                , {
                    data: 'experience'
                    , name: 'experience'
                }
                , {
                    data: 'description'
                    , name: 'description'
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
