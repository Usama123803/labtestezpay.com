<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    @include('includes.patient.styles')

    @stack('css')

</head>

<body>

<div class="page-wrapper">

    @include('includes.patient.header')

    @yield('content')

    @include('includes.patient.footer')

    @include('includes.patient.scripts')
</div>
</body>
</html>
