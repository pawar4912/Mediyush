<!DOCTYPE html>
<html lang="en">
@include('admin.common.head')

<body>
    <div class="container-scroller">
        @include('admin.common.header')

        <div class="container-fluid page-body-wrapper">

            @include('admin.common.sidebar')
            <main id="main" class="main">
                <div class="card col-md-7">
                    <div class="card-body">
                        <h5 class="card-title">Add Job</h5>

                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <form class="row g-3" method="post" action="/admin/jobs/add">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="inputName5" name="name" >
                                </div>
                                <div class="col-md-12">
                                    <label for="inputEmail5" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="inputEmail5" name="email" >
                                </div>
                                <div class="col-md-12">
                                    <label for="inputCompanyName5" class="form-label">Company
                                        Name</label>
                                    <input type="text" class="form-control" id="inputEmail5" name="company_name" >
                                </div>
                                <div class="col-md-12">
                                    <label for="inputPhoneNumber5" class="form-label">Phone
                                        Number</label>
                                    <input type="text" class="form-control" id="inputPhoneNumber5" name="phone_number" >
                                </div>
                                <div class="col-md-12">
                                    <label for="inputCompanyWebsite2" class="form-label">Company
                                        Website</label>
                                    <input type="text" class="form-control" id="inputCompanyWebsite2" name="company_website" >
                                </div>
                                <div class="col-md-6">
                                    <label for="inputSalary" class="form-label">Salary</label>
                                    <input type="text" class="form-control" id="inputSalary" name="salary" >
                                </div>
                                <div class="col-md-6">
                                    <label for="inputExperience" class="form-label">Experience</label>
                                    <input type="text" class="form-control" id="inputExperience" name="experience" >
                                </div>
                                <div class="col-md-12">
                                    <label for="inputDescription2" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </main>
        </div>
        @include('admin.common.footer')
    </div>
</body>

</html>
