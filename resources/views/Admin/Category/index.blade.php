@extends('Admin.layout.master')
@section('title', __('Category'))
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
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($categories) > 0)
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->category_name }}</td>
                                                <td>{{ $category->status === '1' ? 'Enabled' : 'Disabled' }}</td>

                                                <td>
                                                    <a href="{{ route('category.edit', [$category->id])}}">
                                                        <button type="button" class="btn btn-success"><i
                                                                class="bi bi-pencil-square"></i></button>
                                                    </a>
                                                    <form action="{{route('category.destroy',[$category->id])}}" method="post" style="display:inline">@csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger ml-3"><i
                                                                class="bi bi-trash"></i></button>
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
