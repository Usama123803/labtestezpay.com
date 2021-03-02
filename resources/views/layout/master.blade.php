<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>

    @include('includes.styles')

    @stack('css')

</head>

<body>

<div id="page-top">

    @include('includes.header')

    @yield('content')

    @include('includes.footer')

    @include('includes.scripts')
</div>
</body>
</html>
