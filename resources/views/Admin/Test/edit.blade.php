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
                            <h5 class="card-title">Test</h5>

                            <!-- Horizontal Form -->
                            <form action="{{ route('test.update',[$subtest->id]) }}" method="post" enctype="multipart/form-data">@csrf
@method('put')
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Test Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText" name="sub_test_name" value="{{$subtest->sub_test_name}}">

                                        @if ($errors->has('sub_test_name'))
                                            <strong style="color:red"> {{ $errors->first('sub_test_name') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText" name="price" value="{{$subtest->price}}">

                                        @if ($errors->has('price'))
                                            <strong style="color:red"> {{ $errors->first('price') }}</strong>
                                        @endif
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Sample Type</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText" name="sample_type" value="{{$subtest->sample_type}}">

                                        @if ($errors->has('sample_type'))
                                            <strong style="color:red"> {{ $errors->first('sample_type') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Volume</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText" name="volume" value="{{$subtest->volume}}">

                                        @if ($errors->has('volume'))
                                            <strong style="color:red"> {{ $errors->first('volume') }}</strong>
                                        @endif
                                    </div>
                                </div>


                                {{-- <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Organs</label>
                                    <div class="col-sm-10">
                                        <select class="form-control js-example-basic-single" name="organ_id">

                                            @foreach ($organs as $organ)
                                                <option value="{{ $organ->id }}"  {{$subtest->organ_id === $organ->id?'selected':''}}>{{ $organ->name }}</option>
                                            @endforeach

                                        </select>

                                        @if ($errors->has('organ'))
                                            <strong style="color:red"> {{ $errors->first('organ') }}</strong>
                                        @endif

                                    </div>
                                </div> --}}

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="1" {{$subtest->status === 1?'checked':''}}>
                                            <label class="form-check-label" for="gridRadios1">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="0" {{$subtest->status === 0?'checked':''}}>
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
