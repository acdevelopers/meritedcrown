<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @hasSection("meta_description")
        <meta name="description" content="@yield("meta_description")">
    @endif

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('page_title')@yield('page_title') -@endif Merited Crown International School, Ouagadougou, Burkina Faso</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('stylesheets')
</head>
<body>
    @yield('page')
</body>
</html>
