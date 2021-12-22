<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{asset('/assets/css/custom.css')}}">
    <link rel="stylesheet" href="{{url()->asset('assets/css/all.css')}}">
    @yield('css')
    <title>@yield('title')</title>
</head>
<body>

@include('Website.Sections.header')
@yield('main')
@include('Website.Sections.footer')
<script src="{{url()->asset('assets/js/jquery.min.js')}}"></script>
<script src="{{url()->asset('assets/js/bootstrap.bundle.min.js')}}"></script>
@yield('js')
</body>
</html>
