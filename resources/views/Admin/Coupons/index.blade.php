@extends('Admin.layout.master')
@section('title', __('Coupon'))
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
                                        <th>Coupon Code</th>
                                        <th>Coupon Name</th>
                                        <th>Coupon Type</th>
                                        <th>Coupon Amount/Percntage</th>
                                        <th>Expire At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($coupons) > 0)
                                        @foreach ($coupons as $coupon)
                                            <tr>
                                                <td>{{ $coupon->code }}</td>
                                                <td>{{ $coupon->name }}</td>
                                                <td>{{ $coupon->type === '1' ? 'Fixed' : 'Percentage' }}</td>
                                                <td>{{ $coupon->amount }}{{ $coupon->type === '1' ? '/-' : '%' }}</td>
                                                <td>{{ $coupon->expires_at }}</td>

                                                <td>
                                                    <a href="#">
                                                        <button type="button" class="btn btn-success"><i
                                                                class="bi bi-pencil-square"></i></button>
                                                    </a>
                                                    <form action="#" method="post" style="display:inline">@csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger ml-3"><i
                                                                class="bi bi-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <!-- View Modal -->
                                        @endforeach
                                    @else
                                        <td>No coupons to display</td>
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
