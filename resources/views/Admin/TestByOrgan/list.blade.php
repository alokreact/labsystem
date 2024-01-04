@extends('Admin.layout.master')
@section('title', __('Test By Organ'))
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
                                        <th>Organ Names</th>
                                        <th>Sub Test</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($organs) > 0)
                                        @foreach ($organs as $organ)
                                            <tr>
                                                <td>{{ $organ->name }}</td>
                                                <td>
                                                    @foreach ($organ->subtest as $subtest)
                                                        <span class="badge bg-info text-dark">
                                                            {{ ucfirst($subtest->sub_test_name) }}</span>
                                                    @endforeach
                                                </td>

                                                <td>
                                                    <a href="{{ route('admintestbyorgan.edit', [$organ->id]) }}">
                                                        <button type="button" class="btn btn-success"><i
                                                                class="bi bi-pencil-square"></i></button>
                                                    </a>

                                                    <form action="{{ route('admintestbyorgan.destroy',[$organ->id]) }}"
                                                        method="post" style="display:inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger ml-3">
                                                            <i class="bi bi-trash"></i></button>
                                                    </form>
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
