<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>

    @include('includes.styles')

    @stack('css')

</head>

<body>


<div id="page-top">

@section('title') Terms and Condition - LabWork360 @endsection

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="https://labwork360.com/"><img src="assets/img/logo.png" alt="" style="height: 60px;" /></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ml-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="https://labwork360.com/">Covid testing for traveler's</a></li>
                
            </ul>
        </div>
    </div>
</nav>


@section('content')

{{--  ADD HTML HERE  --}}

<div>
<h1>Term & Conditions.</h1>

<p>The answers below shall be truthful and inclusive for all members of household (including children and live-in adults). Within the past 14 days:  

1)	Although Labtest diagnostics & Labtest EZPay try their best to deliver the results on time but does not guarantee the delivery of results in time and accept no responsibility for it. </p>

</div>
</body>
</html>


@endsection

@push('js')

@endpush


