@extends('Admin.layout.master')

@section('title', __('Lab'))
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
          <h5 class="card-title">Labs</h5>
          <!-- Horizontal Form -->
          <form  action="{{route('lab.store') }}" method="post" enctype="multipart/form-data">@csrf
          
          <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Lab Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputText" name="lab_name">

                @if($errors->has('lab_name'))
                    <strong style="color:red"> {{ $errors->first('lab_name') }}</strong>
                             @endif
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Address1</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputText" name="address1">

                @if($errors->has('address1'))
                                 <strong style="color:red"> {{ $errors->first('address1') }}</strong>
                             @endif
              </div>
            </div>
          
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">City</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputText" name="city">

                @if($errors->has('city'))
                                 <strong style="color:red"> {{ $errors->first('city') }}</strong>
                             @endif
            
               </div>
            </div>
          
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Pin</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputText" name="pin">

                @if($errors->has('pin'))
                                 <strong style="color:red"> {{ $errors->first('pin') }}</strong>
                             @endif
              </div>
            </div>
          
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">State</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputText" name="state">

                @if($errors->has('state'))
                                 <strong style="color:red"> {{ $errors->first('state') }}</strong>
                             @endif
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Phone</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputText" name="phone">

                @if($errors->has('phone'))
                                 <strong style="color:red"> {{ $errors->first('phone') }}</strong>
                             @endif
              </div>
            </div>
          

            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Image</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" id="inputText" name="image">

                @if($errors->has('image'))
                                 <strong style="color:red"> {{ $errors->first('image') }}</strong>
                             @endif
              </div>
            </div>
          
            <fieldset class="row mb-3">
              <legend class="col-form-label col-sm-2 pt-0">Status</legend>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status"   value="1" >
                  <label class="form-check-label" for="gridRadios1">
                    Active
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status"  value="0">
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