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
                            <h5 class="card-title">users</h5>
                            <!-- Horizontal Form -->
                            <form action="{{ route('user.update', [$user->id]) }}" method="post"
                                enctype="multipart/form-data">
                                {{method_field('put') }}
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Position</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText" name="name"
                                            value="{{ $user->name }}" />
                                        @if ($errors->has('position'))
                                            <strong style="color:red"> {{ $errors->first('position') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Url</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText" name="email"
                                            value={{ $user->email }}>
                                        @if ($errors->has('email'))
                                            <strong style="color:red"> {{ $errors->first('email') }}</strong>
                                        @endif
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Phone</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText" name="phone"
                                            value={{ $user->phone }}>
                                        @if ($errors->has('phone'))
                                            <strong style="color:red"> {{ $errors->first('phone') }}</strong>
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
