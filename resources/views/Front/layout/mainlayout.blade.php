<html>
<head>
    @include('Front.layout.partials.head')
</head>
    <body>
        @include('Front.layout.partials.header')

        @yield('content')

        @include('Front.layout.partials.footer')
     
    </body>
</html>