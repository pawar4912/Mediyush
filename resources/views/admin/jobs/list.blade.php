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
                    <div class="card-body">
                        <h5 class="card-title">Job Lists</h5>
                        @if (session('success'))
                            <div class="col-sm-12">
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Company Name</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Company Website</th>
                                    <th scope="col">Salary</th>
                                    <th scope="col">Experience</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobs as $job)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $job->name }}</td>
                                        <td>{{ $job->email }}</td>
                                        <td>{{ $job->company_name }}</td>
                                        <td>{{ $job->phone_number }}</td>
                                        <td>{{ $job->company_website }}</td>
                                        <td>{{ $job->salary }}</td>
                                        <td>{{ $job->experience }}</td>
                                        <td>{{ $job->description }}</td>
                                        <td>
                                            <?php if(!$job->status){ ?>

                                            <a href="/admin/jobs/activate/{{ $job->id }}"
                                                class="btn btn-success">Activate</a>

                                            <?php }else{ ?>

                                            <a href="/admin/jobs/deactivate/{{ $job->id }}"
                                                class="btn btn-danger">Deactivate</a>

                                            <?php } ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-secondary" data-toggle="modal"
                                                data-target="#modal-{{ $loop->iteration }}">
                                                <i class="ri-edit-2-line"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <div id="modal-{{ $loop->iteration }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="card-body">
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                    <h5 class="card-title">Edit Job</h5>

                                                    <!-- Multi Columns Form -->
                                                    <form method="post" action="/admin/jobs/edit/{{ $job->id }}">
                                                        @csrf
                                                        <div class="row g-3">
                                                            <div class="col-md-12">
                                                                <label for="inputName5" class="form-label">Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="inputName5" name="name"
                                                                    value="{{ $job->name }}">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="inputEmail5"
                                                                    class="form-label">Email</label>
                                                                <input type="email" class="form-control"
                                                                    id="inputEmail5" name="email"
                                                                    value="{{ $job->email }}">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="inputCompanyName5"
                                                                    class="form-label">Company
                                                                    Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="inputEmail5" name="company_name"
                                                                    value="{{ $job->company_name }}">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="inputPhoneNumber5" class="form-label">Phone
                                                                    Number</label>
                                                                <input type="text" class="form-control"
                                                                    id="inputPhoneNumber5" placeholder="1234 Main St"
                                                                    name="phone_number"
                                                                    value="{{ $job->phone_number }}">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="inputCompanyWebsite2"
                                                                    class="form-label">Company
                                                                    Website</label>
                                                                <input type="text" class="form-control"
                                                                    id="inputCompanyWebsite2"
                                                                    placeholder="Apartment, studio, or floor"
                                                                    name="company_website"
                                                                    value="{{ $job->company_website }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="inputSalary"
                                                                    class="form-label">Salary</label>
                                                                <input type="text" class="form-control"
                                                                    id="inputSalary" name="salary"
                                                                    value="{{ $job->salary }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="inputExperience"
                                                                    class="form-label">Experience</label>
                                                                <input type="text" class="form-control"
                                                                    id="inputExperience" name="experience"
                                                                    value="{{ $job->experience }}">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="inputDescription2"
                                                                    class="form-label">Description</label>
                                                                <input type="text" class="form-control"
                                                                    id="inputDescription2"
                                                                    placeholder="Apartment, studio, or floor"
                                                                    name="description"
                                                                    value="{{ $job->description }}">
                                                            </div>
                                                            <div class="col-12 text-center">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Update</button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $jobs->links() }}
                    </div>
                </div>
            </main>
            @include('admin.common.footer')
        </div>
    </div>
</body>

</html>
