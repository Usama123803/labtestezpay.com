<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

{{--    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>--}}

    <title>@yield('title')</title>

    @include('includes.portal.styles')

    @stack('css')

</head>


<body class="user-profile">
    <div class="wrapper ">
        @include('includes.portal.sidebar')
        <div class="main-panel" id="main-panel">
        @include('includes.portal.header')

        @yield('content')

        @include('includes.portal.footer')


        </div>
        @include('includes.portal.scripts')
    </div>
</body>
</html>
