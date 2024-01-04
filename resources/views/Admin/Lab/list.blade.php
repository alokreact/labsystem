@extends('Admin.layout.master')
@section('title', __('Lab'))
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
                                        <th>Lab Name</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Pin</th>

                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($labs) > 0)
                                        @foreach ($labs as $key => $lab)
                                            <tr>
                                                <td>{{ $lab->lab_name }}</td>
                                                <td>{{ $lab->state }}</td>
                                                <td>{{ $lab->city }}</td>
                                                <td>{{ $lab->pin }}</td>

                                                <td>
                                                    <a href="{{ route('lab.edit', [$lab->id]) }}">
                                                        <button type="button" class="btn btn-success"><i
                                                                class="bi bi-pencil-square"></i></button>
                                                    </a>

                                                    <form action="{{ route('lab.destroy', [$lab->id]) }}" method="post"
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
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>
@endsection
