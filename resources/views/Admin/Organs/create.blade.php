@extends('Admin.layout.master')
@section('content')
    <main id="main" class="main">
        @include('Admin.layout.partials.breadcrumb')


        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    @include('Admin.layout.partials.alert')

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Organs</h5>

                            <!-- Horizontal Form -->
                            <form action="{{ route('organ.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText" name="name">
                                        @if ($errors->has('name'))
                                            <strong style="color:red"> {{ $errors->first('name') }}</strong>
                                        @endif

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="inputEmail" name="image">
                                        @if ($errors->has('image'))
                                            <strong style="color:red"> {{ $errors->first('image') }}</strong>
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
