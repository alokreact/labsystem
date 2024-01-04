@extends('Admin.layout.master')
@section('title', __('Prescription'))
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
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Prescription</th>
                                    <th scope="col">Order Date</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if (count($prescriptions) > 0)
                                @foreach ($prescriptions as $prescription)
                                <tr>
                                    <td>{{ $prescription->name }}</td>
                                    <td>{{ $prescription->phone }}</td>
                                    <td> 
                                        <a href="{{route('prescription.download',[$prescription->id])}}">Download</a>
                                    </td>

                                    <td>{{ date('Y-m-d H:i:s', strtotime($prescription->created_at)) }}</td>

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