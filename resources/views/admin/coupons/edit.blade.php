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
                        <h5 class="card-title">Edit Couponse</h5>

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
                        @if (session('error'))
                        <div class="col-sm-12">
                            <div class="alert alert-danger">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                        <form class="row g-3" method="post" action="/admin/coupons/edit/{{$coupon->id}}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <label class="form-label">Code</label>
                                <input type="text" class="form-control" id="code" name="code" value={{$coupon->code}}>
                            </div>
                            <div class="col-md-12">
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Type</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="type1" value="fix_price" {{$coupon->type == 'fix_price' ? 'checked' : ''}} onClick="changeType('amount')">
                                            <label class="form-check-label" for="type1">
                                                Fix Price
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="type2" value="percentage" {{$coupon->type == 'percentage' ? 'checked' : ''}} onClick="changeType('percentage')">
                                            <label class="form-check-label" for="type2">
                                                Percentage
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Minimum Amount Required</label>
                                <input type="number" class="form-control" id="minimum_amount_required" name="minimum_amount_required"value={{$coupon->minimum_amount_required}}>
                            </div>
                            <div class="col-md-12" style="display: {{$coupon->type == 'fix_price' ? '' : 'none'}};" id="amount-wrapper">
                                <label class="form-label">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount" value={{$coupon->amount}}>
                            </div>
                            <div class="col-md-12" style="display: {{$coupon->type == 'percentage' ? '' : 'none'}};" id="percentage-wrapper">
                                <label class="form-label">Percentage</label>
                                <input type="number" class="form-control" id="percentage" name="percentage" value={{$coupon->percentage}}>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description">{{$coupon->description}}</textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>
            </main>
        </div>
        @include('admin.common.footer')
    </div>
</body>

</html>
<script>
    function changeType(type) {
        if (type == 'amount') {
            document.getElementById('amount-wrapper').style.display = '';
            document.getElementById('percentage-wrapper').style.display = 'none';
        } else if (type == 'percentage') {
            document.getElementById('amount-wrapper').style.display = 'none';
            document.getElementById('percentage-wrapper').style.display = '';
        }
    }

</script>
