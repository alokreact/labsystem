@extends('Admin.layout.master')
@section('content')

@section('title', __('Package'))
@section('action', __('List'))

<main id="main" class="main">
    @include('Admin.layout.partials.breadcrumb')



    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Default Table</h5>

                        <!-- Default Table -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>package Name</th>
                                    <th>Category Name</th>
                                    <th>Lab Name</th>
                                    <th>price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (count($packages) > 0)
                                    @foreach ($packages as $package)
                                        <tr>
                                            <td>{{ $package->package_name }}</td>
                                            <td>{{ optional($package->getLab)->lab_name }}</td>
                                            <td>{{ optional($package->getCategory)->category_name }}</td>
                                            <td>{{ $package->price }}</td>

                                            <td>
                                                <a href="{{ route('package.edit', $package->id) }}"
                                                    class="btn btn-success"><i class="bi bi-pencil-square"></i></a>

                                                <form action="{{ route('package.destroy', [$package->id]) }}"
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
                                    <td>No package</td>
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
