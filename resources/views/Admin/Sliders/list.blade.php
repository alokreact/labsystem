@extends('Admin.layout.master')
@section('content')

@section('title', __('Sliders'))
@section('action', __('List'))

<main id="main" class="main">
    @include('Admin.layout.partials.breadcrumb')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                
                   @include('Admin.layout.partials.alert')


                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Default Table</h5>

                        <!-- Default Table -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Slider Position</th>
                                    <th>Slider Link Url</th>
                                    <th>Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (count($sliders) > 0)
                                    @foreach ($sliders as $slider)
                                        <tr>
                                            <td>{{ $slider->position }}</td>
                                            <td>{{ $slider->url }}</td>
                                            <td> <img src="{{asset('images/bg/'.$slider->image)}}"  class="img-responsive" height="100px" width="100px"/></td>
                                           
                                            <td>
                                                <a href="{{route('slider.edit',[$slider->id])}}"
                                                    class="btn btn-success"><i class="bi bi-pencil-square"></i></a>

                                                <form action="{{ route('slider.destroy', [$slider->id]) }}"
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
