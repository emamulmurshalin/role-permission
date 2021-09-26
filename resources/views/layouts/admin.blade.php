<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.includes.header')
</head>

<body>
<!-- Preloader Start Here -->
<div id="preloader"></div>

<div id="app" class="wrapper bg-ash" style="min-height: 900px;">
    <!-- Header Menu Area Start Here -->
@include('layouts.includes.navbar')

<!-- Page Area Start Here -->
    <div class="dashboard-page-one">
        <!-- Sidebar Area Start Here -->
        @include('layouts.includes.sidebar')

        <div class="dashboard-content-one" style="margin-top: 35px;">
        @yield('contents')

        @include('layouts.includes.footer')
        <!-- Footer Area End Here -->
        </div>
    </div>
</div>
@include('layouts.includes.footerjs')

<script type="text/javascript">
    @auth
        window.getPermission = {!! json_encode(Auth::user()->allPermissions, true) !!};
    @else
        window.getPermission = [];
    @endauth
</script>

</body>

</html>
