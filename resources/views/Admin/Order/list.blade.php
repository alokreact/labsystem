@extends('Admin.layout.master')
@section('title', __('Orders'))
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
                                        <th>Order Id</th>
                                        <th>Order Option</th>
                                        <th>Amount</th>
                                        <th scope="col">Order Date</th>
                                        <th scope="col">Payment Status</th>
                                        <th scope="col"> Status</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">View</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @if (count($orders) > 0)
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->recieptId }}</td>
                                                <td>{{ $order->pay_option === '2' ? 'COD' : 'RAZORPAY' }}</td>
                                                <td>{{ $order->total }}</td>
                                                <td>{{ \Carbon\Carbon::parse($order->created_at)->forMat('d-m-Y') }}</td>
                                                <td>
                                                    @if ($order->status === '1')
                                                        <span class="badge bg-success">COMPLETE ONLINE</span>
                                                    @else
                                                        <span class="badge bg-warning">PENDING</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <select name="status" class="form-control status" data-orderId ="{{$order->id}}">
                                                        <option value="">Pending</option>
                                                       
                                                        <option value="3" {{$order->order_status === '3'?'selected':''}}>Sample Collected</option>
                                                        <option value="4" {{$order->order_status === '4'?'selected':''}}>Sample Processing</option>
                                                        <option value="5" {{$order->order_status === '5'?'selected':''}}>Completed</option>
                                                    </select>
                                                </td>

                                                <td>
                                                    <a href="{{ route('order.download', [$order->id]) }}">
                                                        <span class="badge bg-success">Download</span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form method="get" action="{{ route('show.order') }}">
                                                        <input type="hidden" value="{{ $order->id }}" name="itemId" />
                                                        <input type="hidden" value="{{ $order->type }}" name="type" />
                                                        <button type="submit" class="btn btn-primary open-modal">
                                                            View
                                                        </button>

                                                    </form>
                                                </td>


                                            </tr>
                                            <!-- View Modal -->
                                        @endforeach
                                    @else
                                        <td>No Order to display</td>
                                    @endif
                                </tbody>
                            </table>

                            <!-- End Default Table Example -->
                        </div>

                        @include('Admin.Order.modal')

                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('after-order-scripts')
    <script></script>
@endpush
