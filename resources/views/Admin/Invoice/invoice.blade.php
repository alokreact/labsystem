@extends('Admin.layout.partials.head')

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Order</title>

    <style type="text/css">
        body {
            margin-top: 20px;
            background: #eee;
            font-family: Arial, sans-serif;
        }

        .invoice {
            background: #fff;
            padding: 20px
        }

        .invoice-company {
            font-size: 20px
        }

        .invoice-header {
            margin: 0 -20px;
            background: #f0f3f4;
            padding: 20px
        }

        .invoice-date,
        .invoice-from,
        .invoice-to {
            display: inline;
            width: 1%
        }

        .invoice-from,
        .invoice-to {
            padding-right: 20px
        }

        .invoice-date .date,
        .invoice-from strong,
        .invoice-to strong {
            font-size: 16px;
            font-weight: 600
        }

        .invoice-date {
            text-align: right;
            padding-left: 20px
        }

        .invoice-price {
            background: #f0f3f4;
            display: table;
            width: 100%
        }

        .invoice-price .invoice-price-left,
        .invoice-price .invoice-price-right {
            display: table-cell;
            padding: 20px;
            font-size: 20px;
            font-weight: 600;
            width: 75%;
            position: relative;
            vertical-align: middle
        }

        .invoice-price .invoice-price-left .sub-price {
            display: table-cell;
            vertical-align: middle;
            padding: 0 20px
        }

        .invoice-price small {
            font-size: 12px;
            font-weight: 400;
            display: block
        }

        .invoice-price .invoice-price-row {
            display: table;
            float: left
        }

        .invoice-price .invoice-price-right {
            width: 25%;
            background: #2d353c;
            color: #fff;
            font-size: 28px;
            text-align: right;
            vertical-align: bottom;
            font-weight: 300
        }

        .invoice-price .invoice-price-right small {
            display: block;
            opacity: .6;
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 12px
        }

        .invoice-footer {
            border-top: 1px solid #ddd;
            padding-top: 10px;
            font-size: 10px
        }

        .invoice-note {
            color: #999;
            margin-top: 80px;
            font-size: 85%
        }

        .invoice>div:not(.invoice-footer) {
            margin-bottom: 20px
        }

        .btn.btn-white,
        .btn.btn-white.disabled,
        .btn.btn-white.disabled:focus,
        .btn.btn-white.disabled:hover,
        .btn.btn-white[disabled],
        .btn.btn-white[disabled]:focus,
        .btn.btn-white[disabled]:hover {
            color: #2d353c;
            background: #fff;
            border-color: #d9dfe3;
        }
    </style>
</head>

<body>


    <div class="container">
        <div class="col-md-12">
            <div class="invoice">
                <div class="invoice-company text-inverse f-w-600">
                    <span class="pull-right hidden-print">
                    </span>
                    CALL LABS, Vasavi Colony, Kothapet, 500084, Hyderabad.
                </div>

                <div class="invoice-header">
                    <div class="invoice-from">
                        Invoice #: {{ $order->recieptId }}<br />
                        Created: {{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}
                    </div>
                </div>

                <div class="row">
                    <div class="invoice-to col-md-6">
                        <small>To</small>
                        <address class="m-t-5 m-b-5">
                            <strong class="text-inverse">{{ $order->user_name }}</strong><br>
                            {{ $order->user_email }}<br>
                            {{$order->user_address}},<br>
                            Phone: {{ $order->user_phone}}.<br>
                        </address>
                    </div>

                    <div class="invoice-date col-md-6">
                        <address class="m-t-5 m-b-5">
                            <strong class="text-inverse">Sample Collection Date: {{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}</strong><br>
                            Time: {{ $order->collection_time }}<br>
                        </address>
                    </div>
                </div>



                <!-- end invoice-header -->
                <!-- begin invoice-content -->
                <div class="invoice-content">
                    <!-- begin table-responsive -->
                    <div class="table-responsive">
                        <table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th width="60%">TESTS</th>
                                    <th class="text-center" width="20%">PRICE</th>
                                    <th class="text-right" width="10%">LAB NAME</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($tests as $test)
                                <tr>
                                    <td width="40%">
                                        @foreach($test->subtest as $subtest)
                                        <span class="text-inverse">{{ ucfirst($subtest->sub_test_name) }}</span><br>
                                        @endforeach
                                    </td>
                                    <td class="text-center" width="20%">₹{{ $test->price }}</td>
                                    <td class="text-right" width="10%">{{ ucfirst($test->lab_id) }}</td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- end table-responsive -->
                    <!-- begin invoice-price -->

                    <div class="invoice-price">
                        <div class="invoice-price-left">
                            <div class="invoice-price-row">
                                <div class="sub-price">
                                    <small>SUBTOTAL</small>
                                    <span class="text-inverse"></span>
                                </div>
                                <div class="sub-price">
                                    <i class="fa fa-plus text-muted"></i>
                                </div>
                                <div class="sub-price">
                                    <!-- <small>PAYPAL FEE (5.4%)</small> -->
                                    <span class="text-inverse">₹{{$order->total}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="invoice-price-right">
                            <small>
                                <h4>TOTAL</h4>
                            </small>
                            <span class="f-w-600">₹{{$order->total}}</span>
                        </div>
                    </div>
                    <!-- end invoice-price -->
                </div>
                <!-- end invoice-content -->
                <!-- begin invoice-note -->
                <div class="invoice-note">
                    * If you have any questions concerning this invoice, contact [+91-7893762020, support@callabs.in]
                </div>
                <!-- end invoice-note -->
                <!-- begin invoice-footer -->
                <div class="invoice-footer">
                    <p class="text-center m-b-5 f-w-600">
                        THANK YOU FOR YOUR APPOINTMENT.
                    </p>
                </div>
                <!-- end invoice-footer -->
            </div>
        </div>
    </div>

</body>

</html>