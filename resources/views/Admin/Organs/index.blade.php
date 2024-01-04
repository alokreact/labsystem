@extends('Admin.layout.master')

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
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Organ Name</th>

                                        <th>Image</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($allOrgans) > 0)
                                        @foreach ($allOrgans as $key => $organ)
                                            <tr>
                                                <td>{{ $organ->name }}</td>
                                                <td><img src="{{ asset('Image/' . $organ->image) }}" height='80px'
                                                        width='80px' /></td>

                                                <td>
                                                    <a href="{{ route('organ.edit', [$organ->id]) }}">
                                                        <button type="button" class="btn btn-success"><i
                                                                class="bi bi-pencil-square"></i></button>
                                                    </a>

                                                    <form action="{{route('organ.destroy',[$organ->id])}}" method="post" style="display:inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger ml-3">
                                                            <i class="bi bi-trash"></i></button>
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
