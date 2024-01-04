@extends('Admin.layout.master')

@section('title', __('Appoinemnt'))
@section('action', __('List'))

@section('content')

<main id="main" class="main">

@include('Admin.layout.partials.breadcrumb')


<section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Default Table</h5>

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                  <th> Name</th>
                  <th> Address</th>
                  <th> Phone</th>
                                <th>State</th>
                           
                  </tr>
                </thead>
                <tbody>
                @if (count($appointments) > 0)
                                @foreach ($appointments as $appointment)
                                     <tr>
                                        <td>{{ $appointment->name }}</td>
                                        <td>{{ $appointment->address1 }}</td>
                                        <td>{{ $appointment->phone }}</td>
                                        <td>{{ $appointment->state }}</td>
                                      
                                       
                                    </tr>
                                 
                                    <!-- View Modal -->
                                    
                                @endforeach

                            @else
                                <td>No user to display</td>
                            @endif
   
                </tbody>
              </table>
              <!-- End Default Table Example -->
            </div>
          </div>

        </div>

       </div>
    </section>

</main>
@endsection