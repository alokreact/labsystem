@extends('Admin.layout.master')
@section('title', __('TestByOrgan'))
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
                            <h5 class="card-title">Category</h5>

                            <!-- Horizontal Form -->
                            <form action="{{ route('admintestbyorgan.store') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Organ Name</label>

                                    <div class="col-sm-10">
                                        <select class="form-control" name="organ">
                                            @foreach ($organs as $organ)
                                                <option value="{{ $organ->id }}">{{ $organ->name }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('organ'))
                                            <strong style="color:red">{{ $errors->first('organ') }}</strong>
                                        @endif
                                    </div>
                                </div>


                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Test</legend>
                                    <div class="col-sm-10">
                                        <select class="form-control js-example-tags" multiple="multiple" name="sub_tests[]">
                                            @foreach ($sub_tests as $subtest)
                                                <option value="{{ $subtest->id }}">{{ $subtest->sub_test_name }}</option>
                                            @endforeach

                                        </select>
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
