@extends('Admin.layout.master')
@section('content')

@section('title', __('Users'))
@section('action', __('List'))

<main id="main" class="main">
    @include('Admin.layout.partials.breadcrumb')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                
                   @include('Admin.layout.partials.alert')


                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>

                        <!-- Default Table -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (count($users) > 0)
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td> {{ $user->email }}</td>
                                         
                                            {{--    {{ route('user.destroy', [$user->id]) }}--}}
                                            <td>
                                                <a href="{{route('user.edit',[$user->id])}}"
                                                    class="btn btn-success"><i class="bi bi-pencil-square"></i></a>

                                                <form action="#"
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
                                    <td>No Users Found!</td>
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
