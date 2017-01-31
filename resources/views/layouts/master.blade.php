<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>shcart | @yield('title')</title>
    @include('partials.styles')
    @yield('styles')
</head>
<body>

    @include('partials.header')
    
    @yield('slider')

    @yield('content')        
   
    @include('partials.footer')

    @include('partials.scripts')
    
    @yield('scripts')
</body>
</html>