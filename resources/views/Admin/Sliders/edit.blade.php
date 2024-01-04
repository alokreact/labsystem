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
                            <h5 class="card-title">Sliders</h5>
                            <!-- Horizontal Form -->
                            <form action="{{ route('slider.update', [$slider->id]) }}" method="post"
                                enctype="multipart/form-data">
                                {{method_field('put') }}
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Position</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText" name="name"
                                            value="{{ $slider->position }}" />
                                        @if ($errors->has('position'))
                                            <strong style="color:red"> {{ $errors->first('position') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Url</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText" name="url"
                                            value={{ $slider->url }}>
                                        @if ($errors->has('url'))
                                            <strong style="color:red"> {{ $errors->first('url') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="inputEmail" name="image"
                                            onchange="previewImage(event)">

                                        <img id="imagePreview" src="#" alt="Image Preview"
                                            style="display: none; max-width: 200px; max-height: 200px;">
                                        @if ($errors->has('image'))
                                            <strong style="color:red"> {{$errors->first('image') }}</strong>
                                        @endif

                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <img src="{{ asset('images/bg/' . $slider->image) }}" height='100px' width='100px' />

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
