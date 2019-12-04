<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/sweetalert2.css') }}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
@include('layouts.header')
@include('layouts.sidebar-left')
    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>
    @include('layouts.footer')
</div>
</body>
@stack('js')
</html>

