<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    @include('includes.styles')

    @stack('css')

</head>

<body>

<div class="page-wrapper">

    @include('includes.header')

    @yield('content')

    @include('includes.footer')

    @include('includes.scripts')
</div>
</body>
</html>
