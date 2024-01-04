@extends('Admin.layout.master')
@section('title', __('Cashback'))
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
                                        <th>Order Amount </th>
                                        <th>Mobile </th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($cashabacks) > 0)
                                        @foreach ($cashabacks as $cashback)
                                            <tr>
                                                <td>{{ $cashback->order_amount }}</td>
                                                <td>{{ $cashback->mobile }}/-</td>
                                                <td>{{ $cashback->status === 1 ? 'Pending' : 'Complete' }}</td>
                                                <td>
                                                    <select name="cashback_status" class="form-control">

                                                        <option value="1">Reject</option>
                                                        <option value="2">Complete</option>
                                                        <option value="3">Pending</option>
                                                    </select>
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
