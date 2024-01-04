@extends('Admin.layout.master')
@section('title', __('GroupTest'))
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
                            <h5 class="card-title">Group Test</h5>

                            <!-- Horizontal Form -->
                            <form action="{{ route('grouptest.store') }}" method="post" enctype="multipart/form-data">@csrf
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Group Test Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText" name="name">

                                        @if ($errors->has('name'))
                                            <strong style="color:red"> {{ $errors->first('name') }}</strong>
                                        @endif
                                    </div>
                                </div>


                                {{-- <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Group Test Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText" name="sub_tests[]" >

                                        @if ($errors->has('sub_tests'))
                                            <strong style="color:red"> {{ $errors->first('sub_tests') }}</strong>
                                        @endif
                                    </div>
                                </div> --}}


                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Sub Test</label>
                                    <div class="col-sm-10">
                                        <select class="form-control js-example-tags" multiple="multiple" name="sub_tests[]">
                                            @foreach ($sub_tests as $subtest)                
                                                <option value="{{ $subtest->id }}">{{ $subtest->sub_test_name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('sub_tests'))
                                            <strong style="color:red"> {{ $errors->first('	sub_tests') }}</strong>
                                        @endif
                                    </div>
                                </div> 



                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="1">
                                            <label class="form-check-label" for="gridRadios1">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="0">
                                            <label class="form-check-label" for="gridRadios2">
                                                Inactive
                                            </label>
                                        </div>

                                        @error('status')
                                            <strong style="color:red">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </fieldset>
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
