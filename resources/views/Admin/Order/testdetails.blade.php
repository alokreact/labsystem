@extends('Admin.layout.master')
@section('title', __('Test'))
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
                                        <th width="30%">Lab Name</th>
                                        <th width="30%">Test Name</th>
                                        <th width="20%">Price</th>
                                        <th width="10%">Upload</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @if (count($data) > 0)
                                        @foreach ($data['subtest'] as $test)
                                            <tr>
                                                <td>{{$test['lab']['lab_name']}}</td>
                                                <td>{{ $test['subtest'][0]['sub_test_name'] }}</td>
                                                <td>{{ $test['price'] }}/-</td>
                                                <td>

                                                    @if ($test['report_url'] !== null)
                                                        <div class="upload-file-preview">
                                                        

                                                            <i class="bi-file-earmark-plus open-report"
                                                                data-record-id="{{ $test['id'] }}"
                                                                style="cursor: :pointer"></i>

                                                            {{-- <button type="button" id="removeFileBtn">Remove</button> --}}

                                                        </div>
                                                    @else
                                                        <div id="">
                                                            <input type="file" class="custom-file-input" id="fileInput"
                                                                data-orderId="{{ $test['order_id'] }}"
                                                                data-testId="{{ $test['id'] }}"
                                                                data-user_id="{{ $test['user_id'] }}">


                                                            <div class="upload-spinner d-none">
                                                                <div class="spinner-border text-primary" role="status">
                                                                    <span class="sr-only">...</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                            <!-- View Modal -->
                                            @include('Admin.Order.modal')
                                        @endforeach
                                    @else
                                        <td>No Test to display</td>
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
@push('after-order-scripts')
    <script></script>
@endpush
