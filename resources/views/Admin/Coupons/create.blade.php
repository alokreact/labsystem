@extends('Admin.layout.master')
@section('title', __('Coupon'))
@section('action', __('Create'))

@section('content')

    <main id="main" class="main">
        @include('Admin.layout.partials.breadcrumb')
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    @include('Admin.layout.partials.alert')

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create Coupon</h5>
                            <!-- Horizontal Form -->
                            <form action="{{ route('coupon.store') }}" method="post" enctype="multipart/form-data">@csrf

                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Coupon Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText" name="name">

                                        @if ($errors->has('name'))
                                            <strong style="color:red"> {{ $errors->first('name') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Type</label>

                                    <div class="col-sm-10">

                                        <select class="form-control" name="type">
                                            <option value="1">Fixed</option>
                                            <option value="2">Percentage</option>
                                        </select>

                                        @if ($errors->has('type'))
                                            <strong style="color:red"> {{ $errors->first('type') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Percentage/Amount</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText" name="percentage">

                                        @if ($errors->has('percentage'))
                                            <strong style="color:red"> {{ $errors->first('percentage') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Expire At</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="expire_at" name="expire_at">

                                        @if ($errors->has('expire_at'))
                                            <strong style="color:red"> {{ $errors->first('expire_at') }}</strong>
                                        @endif
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">User</label>
                                    <div class="col-sm-10">
                                        <select class="form-control js-example-tags"  name="user_id">
                                            @foreach ($users as $user)                
                                                <option value="{{ $user->id}}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('user_id'))
                                            <strong style="color:red"> {{ $errors->first('	user_id') }}</strong>
                                        @endif
                                    </div>
                                </div> 



                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form><!-- End Horizontal Form -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection
