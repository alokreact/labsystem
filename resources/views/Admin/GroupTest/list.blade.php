@extends('Admin.layout.master')
@section('title', __('GroupTest'))
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
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Grouptest Name</th>
                                        <th>Sub Tests</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($grouptests) > 0)
                                        @foreach ($grouptests as $grouptest)
                                            <tr>
                                                <td>{{ $grouptest['name'] }}</td>
                                                <td>
                                                    @foreach($grouptest['subtest'] as $subtest)
                                                       <span class="badge bg-info text-dark">
                                                           {{$subtest['sub_test_name']}}</span>
                                                            
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <a href="{{ route('grouptest.edit', [$grouptest['id']]) }}">
                                                        <button type="button" class="btn btn-success"><i
                                                                class="bi bi-pencil-square"></i></button>
                                                    </a>
                                                    <form action="{{route('grouptest.destroy',[$grouptest['id']])}}" method="post" style="display:inline">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger ml-3"><i class="bi bi-trash"></i></button>
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
