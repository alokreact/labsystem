<div class="pagetitle">
  <h1>@yield('title')</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
      <li class="breadcrumb-item">@yield('title')</li>
      <li class="breadcrumb-item active">@yield('action')</li>
    </ol>
  </nav>
</div><!-- End Page Title -->