<!DOCTYPE html>
<html lang="en">
 <head>
   @include('Admin.layout.partials.head')
 </head>
 <body>

@include('Admin.layout.partials.header')


@include('Admin.layout.partials.sidebar')


@yield('content')


@include('Admin.layout.partials.footer')
 
 </body>
</html>
