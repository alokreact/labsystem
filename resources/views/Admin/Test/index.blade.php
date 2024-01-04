@extends('Admin.layout.master')
@section('title', __('Test'))
@section('action', __('List'))

@section('content')
    <main id="main" class="main">
        @include('Admin.layout.partials.breadcrumb', ['first_link' => 'Test'])

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Default Table</h5>
                            <!-- Default Table -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Test Name</th>
                                        <th>Price</th>
                                        <th>Volume</th>
                                        <th>Sample Type</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($subtests) > 0)
                                        @foreach ($subtests as $key => $subtest)
                                            <tr>
                                                <td>{{ $subtest->sub_test_name }}</td>
                                                <td>{{ $subtest->price }}</td>
                                                <td>{{ $subtest->volume }}</td>
                                                <td>{{ $subtest->sample_type }}</td>

                                                <td>
                                                    <a href="{{ route('test.edit', [$subtest->id]) }}">
                                                        <button type="button" class="btn btn-success"><i
                                                                class="bi bi-pencil-square"></i></button>
                                                    </a>
                                                    <form action="{{ route('test.destroy', [$subtest->id]) }}" method="post"
                                                        style="display:inline">@csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger ml-3"><i
                                                                class="bi bi-trash"></i></button>
                                                    </form>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <td>No Test. Please create one.</td>
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
