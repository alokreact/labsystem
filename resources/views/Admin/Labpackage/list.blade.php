@extends('Admin.layout.master')
@section('title', __('LabPackage'))
@section('action', __('List'))
@section('content')
    <main id="main" class="main">
        @include('Admin.layout.partials.breadcrumb')

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List</h5>

                            <!-- Default Table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Lab Name</th>
                                        <th>Sub Test</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($labs) > 0)
                                        @foreach ($labs as $lab)
                                            <tr>
                                                <td>{{ $lab->lab_name }}</td>
                                                <td>
                                                    <ul style="height: 450px ; overflow-x:hidden; overflow-y: scroll ">
                                                    @foreach ($lab->subtest as $subtest)
                                                        
                                                        {{-- <div class="w-1/3 p-2" style="width:33%; paddding:1rem;display: flex ;justify-content: space-around">
                                                        
                                                            <span class="badge bg-danger text-white p-2" style="font-size: 12px">
                                                                {{ ucfirst($subtest->sub_test_name) }}
                                                            </span>

                                                                <span
                                                                class="badge bg-light text-dark">(Price-{{ $subtest->pivot->price }}/-)</span>
    
                                                        </div> --}}
                                                    <li class="p-2"> 
                                                            <span class="badge bg-danger text-white p-2">
                                                            {{ ucfirst($subtest->sub_test_name) }}</span>

                                                            (Price-<span
                                                            class="badge bg-light text-dark">{{ $subtest->pivot->price }}/-</span>)
                                                        </li> 
                                                   
                                                    
                                                    @endforeach
                                                        </ul>
                                                </td>


                                                <td>
                                                    <a href="{{ route('labpackage.edit', [$lab->id]) }}">
                                                        <button type="button" class="btn btn-success"><i
                                                                class="bi bi-pencil-square"></i></button>
                                                    </a>

                                                </td>

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


 